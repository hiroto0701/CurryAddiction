import { ref } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'
import { useAccountStore } from '@/stores/account'
import { useCommonStore } from '@/stores/common'

interface AccountFormState {
  display_name: string | null;
  errors: Record<string, string[]>;
}

export const useAccountFormStore = defineStore('account_form', () => {
  const state = ref<AccountFormState>({
    display_name: null,
    errors: {},
  });

  const accountStore = useAccountStore()
  const commonStore = useCommonStore()

  const setErrors = (errors: Record<string, string[]>): void => {
    state.value.errors = { ...errors };
  };

  const resetErrors = (): void => {
    state.value.errors = {};
  };

  const updateDisplayName = async (displayName: string | null): Promise<void> => {
    try {
      resetErrors()
      const response = await axios.put('/api/service_users/me', { display_name: displayName })

      if (response.status === 200) {
        accountStore.updateDisplayName(response.data.data.display_name)
        resetErrors()
        commonStore.setFlashMessage('更新しました')
        setTimeout(() => {
          commonStore.clearFlashMessage()
        }, 4000)
      } else {
        setErrors({ display_name: ['表示名の更新に失敗しました'] })
      }
    } catch (error) {
      if (axios.isAxiosError(error)) {
        if (error.response?.status === 422) {
          setErrors(error.response.data.errors)
        } else {
          setErrors({ display_name: ['表示名の更新に失敗しました'] })
        }
      } else {
        setErrors({ display_name: ['予期せぬエラーが発生しました'] })
      }
    }
  };

  return { state, setErrors, resetErrors, updateDisplayName }
})