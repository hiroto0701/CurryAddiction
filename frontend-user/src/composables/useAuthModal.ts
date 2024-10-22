import { ref } from 'vue';
import { useAccountStore } from '@/stores/account';
import { useAccountFormStore } from '@/stores/account_form';
import { useCommonStore } from '@/stores/common';

export function useAuthModal() {
  const modalState = ref<'login' | 'email' | 'token' | null>(null);
  const email = ref<string>('');
  const token = ref<string>('');

  const accountStore = useAccountStore();
  const accountFormStore = useAccountFormStore();
  const commonStore = useCommonStore();

  function openAuthModal(modalName: 'login' | 'email' | 'token'): void {
    modalState.value = modalName;

    // モーダルを開くたびに入力データをリセット
    if (modalState.value === 'login') {
      email.value = '';
      token.value = '';
    }
    accountStore.resetErrors();
    document.body.style.overflow = 'hidden';
  }

  function closeAuthModal(): void {
    modalState.value = null;
    document.body.style.overflow = 'auto';
    console.log('実行');
  }

  async function generateToken(): Promise<boolean> {
    try {
      if (!accountStore.emailValidate(email.value)) return false;

      accountFormStore.setEmail(email.value);
      commonStore.startApiLoading();

      const response: boolean = await accountStore.generateToken({ email: email.value });

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
    try {
      if (!accountStore.tokenValidate(token.value)) return false;

      accountFormStore.setToken(token.value);
      commonStore.startApiLoading();

      const loginSuccess: boolean = await accountStore.login({
        email: email.value,
        token: token.value
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
    modalState,
    email,
    token,
    openAuthModal,
    closeAuthModal,
    generateToken,
    login
  };
}
