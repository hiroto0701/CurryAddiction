import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useAccountStore } from '@/stores/account';
import { useAccountFormStore } from '@/stores/account_form';
import { useCommonStore } from '@/stores/common';

interface AuthModalState {
  modalState: 'login' | 'email' | 'token' | null;
  email: string;
  token: string;
}

export const useAuthModalStore = defineStore('authModal', () => {
  const state = ref<AuthModalState>({
    modalState: null,
    email: '',
    token: ''
  });

  function openAuthModal(modalName: 'login' | 'email' | 'token'): void {
    state.value.modalState = modalName;

    // モーダルを開くたびに入力データをリセット
    if (state.value.modalState === 'login') {
      state.value.email = '';
      state.value.token = '';
    }

    const accountStore = useAccountStore();
    accountStore.resetErrors();
    document.body.style.overflow = 'hidden';
  }

  function closeAuthModal(): void {
    state.value.modalState = null;
    document.body.style.overflow = 'auto';
  }

  async function generateToken(): Promise<boolean> {
    const accountStore = useAccountStore();
    const accountFormStore = useAccountFormStore();
    const commonStore = useCommonStore();

    try {
      if (!accountStore.emailValidate(state.value.email)) return false;

      accountFormStore.setEmail(state.value.email);
      commonStore.startApiLoading();

      const response: boolean = await accountStore.generateToken({
        email: state.value.email
      });

      if (response) {
        closeAuthModal();
        openAuthModal('token');
        return true;
      }

      return false;
    } catch (error) {
      throw error;
    } finally {
      commonStore.stopApiLoading();
    }
  }

  async function login(): Promise<boolean> {
    const accountStore = useAccountStore();
    const accountFormStore = useAccountFormStore();
    const commonStore = useCommonStore();

    try {
      if (!accountStore.tokenValidate(state.value.token)) return false;

      accountFormStore.setToken(state.value.token);
      commonStore.startApiLoading();

      const loginSuccess: boolean = await accountStore.login({
        email: state.value.email,
        token: state.value.token
      });

      if (loginSuccess) {
        closeAuthModal();
        return true;
      }

      return false;
    } catch (error) {
      console.log(error);
      throw error;
    } finally {
      commonStore.stopApiLoading();
    }
  }

  return {
    state,
    openAuthModal,
    closeAuthModal,
    generateToken,
    login
  };
});
