import axios from 'axios'
import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { useAccountStore } from '@/stores/account'
import { useCommonStore } from '@/stores/common'

interface AccountFormState {
  email: string
  display_name: string
  avatar_url: string | null
  token: string
  errors: Record<string, string[]>
}

export const useAccountFormStore = defineStore('account_form', () => {
  const state = ref<AccountFormState>({
    email: '',
    display_name: '',
    avatar_url: null,
    token: '',
    errors: {}
  })

  const router = useRouter()
  const accountStore = useAccountStore()
  const commonStore = useCommonStore()

  function setEmail(email: string): void {
    state.value.email = email
  }

  function setToken(token: string): void {
    state.value.token = token
  }

  function setErrors(errors: Record<string, string[]>): void {
    state.value.errors = { ...errors }
  }

  function resetData(): void {
    state.value = {
      email: '',
      display_name: '',
      avatar_url: null,
      token: '',
      errors: {}
    }
  }

  function resetErrors(): void {
    state.value.errors = {}
  }

  // バリデーション条件
  // 空白不可、スペース不可、ひらがな漢字不可、「-,_」以外の記号不可
  function handleNameValidate(handleName: string): boolean {
    const errors: Record<string, string[]> = {}
    const pattern = /^[a-zA-Z0-9-_]+$/

    if (!handleName) {
      errors.handle_name = ['ハンドルネームを入力してください']
    } else if (handleName.length > 20) {
      errors.handle_name = ['ハンドルネームは20字以下で設定してください']
    } else if (handleName.length < 2) {
      errors.handle_name = ['ハンドルネームは2字以上で設定してください']
    } else if (!pattern.test(handleName)) {
      errors.handle_name = ['ハンドルネームに使用できるのは半角英数字、"-"、"_"のみです']
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

  function avatarValidate(fileData: File): boolean {
    const errors: Record<string, string[]> = {}
    const allowedExtensions: Array<string> = ['png', 'jpeg', 'jpg']

    if (fileData) {
      const extension: string = fileData.name.split('.').pop()?.toLowerCase() || ''

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

  async function registerAndLogin(handleName: string): Promise<boolean> {
    try {
      resetErrors()
      const param = {
        email: state.value.email,
        handle_name: handleName
      }
      await axios.get('/sanctum/csrf-cookie')
      const response = await axios.put('/api/service_users/register', param)

      if (response.status === 200) {
        const param = { ...response.data.data, token: state.value.token }
        await accountStore.login(param)
        resetErrors()

        await router.push({ name: 'Home' }).then((): void => {
          commonStore.setFlashMessage('ログインしました')
          setTimeout(() => {
            commonStore.clearFlashMessage()
          }, 4000)
        })
      }
      return true
    } catch (error) {
      if (axios.isAxiosError(error)) {
        if (error.response?.status === 422) {
          setErrors(error.response.data.errors)
        }
      } else {
        setErrors({ handle_name: ['予期せぬエラーが発生しました'] })
      }
      return false
    }
  }

  async function updateDisplayName(displayName: string): Promise<void> {
    try {
      resetErrors()
      commonStore.startApiLoading()

      const response = await axios.put('/api/service_users/display_name', {
        display_name: displayName
      })

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
    } finally {
      commonStore.stopApiLoading()
    }
  }

  async function updateAvatar(fileData: File): Promise<void> {
    try {
      resetErrors()
      commonStore.startUploading()

      const formData = new FormData()
      formData.append('file_data', fileData, fileData.name)
      const config = {
        headers: {
          'content-type': 'multipart/form-data',
          'X-HTTP-Method-Override': 'PUT'
        }
      }

      const response = await axios.post('/api/service_users/avatar', formData, config)

      if (response.status === 200) {
        accountStore.updateAvatar(response.data.data.avatar_url)
        resetErrors()
        commonStore.setFlashMessage('更新しました')
        setTimeout(() => {
          commonStore.clearFlashMessage()
        }, 4000)
      } else {
        setErrors({ avatar: ['プロフィール画像の更新に失敗しました'] })
      }
    } catch (error: unknown) {
      if (axios.isAxiosError(error)) {
        if (error.response?.status === 422) {
          setErrors(error.response.data.errors)
        } else {
          setErrors({ avatar: ['プロフィール画像の更新に失敗しました'] })
        }
      } else {
        setErrors({ avatar: ['予期せぬエラーが発生しました'] })
      }
    } finally {
      commonStore.stopUploading()
    }
  }

  return {
    state,
    setEmail,
    setToken,
    setErrors,
    resetData,
    resetErrors,
    handleNameValidate,
    displayNameValidate,
    avatarValidate,
    registerAndLogin,
    updateDisplayName,
    updateAvatar
  }
})
