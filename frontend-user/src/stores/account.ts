import axios, { AxiosError } from 'axios'
import { ref } from 'vue';
import { useRouter } from 'vue-router'
import { defineStore } from 'pinia'
import { useCommonStore } from '@/stores/common'

interface AccountState {
  id: number | null
  status: string | null
  display_name: string
  handle_name: string
  email: string | null
  profile_path: string | null
  created_at: Date | null
  errors: Record<string, string[]>
}

interface LoginErrorResponse {
  error: string
}

interface ValidationErrorResponse {
  errors: Record<string, string[]>
}

export const useAccountStore = defineStore('account', () => {
  const state = ref<AccountState>({
    id: null,
    status: null,
    display_name: '',
    handle_name: '',
    email: null,
    profile_path: null,
    created_at: null,
    errors: {},
  });

  const router = useRouter()
  const commonStore = useCommonStore()

  function setData(data: AccountState): void {
    state.value = { ...data }
  }

  function resetData(): void {
    state.value = {
      id: null,
      status: null,
      display_name: '',
      handle_name: '',
      email: null,
      profile_path: null,
      created_at: null,
      errors: {},
    }
  }

  function setErrors(errors: Record<string, string[]>): void {
    state.value.errors = { ...errors }
  }

  function resetErrors(): void {
    state.value.errors = {}
  }
  
  // axiosのエラーかどうかチェック
  function isAxiosError(error: any): error is AxiosError {
    return !!error.isAxiosError
  }

  function updateDisplayName(displayName: string): void {
    state.value.display_name = displayName
  }

  function validate(email: string, password: string): boolean {
    const errors: Record<string, string[]> = {}
  
    if (!email) {
      errors.email = ['メールアドレスを入力してください']
    }
  
    if (!password) {
      errors.password = ['パスワードを入力してください']
    }
  
    if (Object.keys(errors).length > 0) {
      setErrors(errors)
      return false
    }
  
    resetErrors()
    return true
  }

  // ログイン
  async function login(payload: { email: string; password: string }): Promise<boolean> {
    try {
      await axios.get('/sanctum/csrf-cookie')
      const response = await axios.post('/api/service_users/login', {
        email: payload.email,
        password: payload.password,
      })

      if (response.status === 200) {
        setData(response.data.data)
        resetErrors()
        commonStore.setFlashMessage('ログインしました')
        router.push({ name: 'Home' })
        setTimeout(() => {
          commonStore.clearFlashMessage()
        }, 4000)
      }
      return true
    } catch (error: unknown) {
      if (axios.isAxiosError(error)) {
        if (error.response) {
          const { response } = error
          if (response.status === 422) {
            setErrors(response.data.errors as ValidationErrorResponse['errors'])
            return false
          } else if (response.status === 401) {
            setErrors({ auth: ['メールアドレスまたはパスワードが違います。'] } as Record<string, string[]>)
            return false
          }
        }
      }
      throw error
    }
  }

  // ログアウト
  async function logout(): Promise<void> {
    try {
      await axios.post('/api/service_users/logout')
      resetData()
      commonStore.setFlashMessage('ログアウトしました')
      router.push({ name: 'Login' })
      setTimeout(() => {
        commonStore.clearFlashMessage()
      }, 4000)
    } catch (error: unknown) {
      if (isAxiosError(error)) {
        const { response } = error
        if (response && response.status === 401) {
          setErrors({ auth: ['ログアウトに失敗しました。'] })
        } else {
          setErrors({ general: ['予期せぬエラーが発生しました。'] })
        }
      } else {
        setErrors({ general: ['予期せぬエラーが発生しました。'] })
      }
    }
  }

  return { state, setData, resetData, setErrors, resetErrors, isAxiosError, updateDisplayName, validate, login, logout }
})
