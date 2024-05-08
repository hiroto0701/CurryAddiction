import axios from 'axios'
import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useAccountStore } from '@/stores/account'
import { useCommonStore } from '@/stores/common'

interface AccountFormState {
  display_name: string
  profile_path: string
  errors: Record<string, string[]>
}

export const useAccountFormStore = defineStore('account_form', () => {
  const state = ref<AccountFormState>({
    display_name: '',
    profile_path: '',
    errors: {},
  });

  const accountStore = useAccountStore()
  const commonStore = useCommonStore()

  function setErrors(errors: Record<string, string[]>): void {
    state.value.errors = { ...errors };
  };

  function resetErrors(): void {
    state.value.errors = {};
  };

  function avatarValidate(fileData: File): boolean {
    const errors: Record<string, string[]> = {}
    const allowedExtensions: Array<string> = ['png', 'jpeg', 'jpg'];
    
    if (fileData) {
      const extension: string = fileData.name.split('.').pop().toLowerCase();

      if (!allowedExtensions.includes(extension)) {
        errors.avatar = ['ファイルは.png .jpeg .jpg形式を指定してください。']
      }
    }

    if (Object.keys(errors).length > 0) {
      setErrors(errors)
      return false
    }
  
    resetErrors()
    return true
  }

  function displayNameValidate(displayName: string): boolean {
    const errors: Record<string, string[]> = {}
  
    if (!displayName) {
      errors.display_name = ['表示名を入力してください']
    } else if (displayName.length > 20) {
      errors.display_name = ['表示名は20字以下で設定してください']
    }
  
    if (Object.keys(errors).length > 0) {
      setErrors(errors)
      return false
    }
  
    resetErrors()
    return true
  }

  async function updateAvatar(fileData: File): Promise<void> {
    try {
      resetErrors()
      const formData = new FormData()
      formData.append('file_data', fileData, fileData.name)
      const config = {
        headers: {
          'content-type': 'multipart/form-data',
          'X-HTTP-Method-Override': 'PUT',
        }
      };
      const response = await axios.post('/api/service_users/avatar', formData, config);

      if (response.status === 200) {
        accountStore.updateProfilePath(response.data.data.profile_path)
        resetErrors()
        commonStore.setFlashMessage('更新しました')
        setTimeout(() => {
          commonStore.clearFlashMessage()
        }, 4000)
      } else {
        setErrors({ avatar: ['プロフィール画像の更新に失敗しました'] })
      }
    } catch (error) {
      if (axios.isAxiosError(error)) {
        if (error.response?.status === 422) {
          setErrors(error.response.data.errors)
        } else {
          setErrors({ avatar: ['プロフィール画像の更新に失敗しました'] })
        }
      } else {
        setErrors({ avatar: ['予期せぬエラーが発生しました'] })
      }
    }
  };

  async function updateDisplayName(displayName: string): Promise<void> {
    try {
      resetErrors()
      const response = await axios.put('/api/service_users/display_name', { display_name: displayName })

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

  return { 
    state, 
    setErrors, 
    resetErrors, 
    displayNameValidate,
    avatarValidate,
    updateDisplayName,
    updateAvatar, 
  }
})
