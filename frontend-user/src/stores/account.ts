import axios, { AxiosError } from 'axios'
import { ref } from 'vue';
import { useRouter } from 'vue-router'
import { defineStore } from 'pinia'
import { useCommonStore } from '@/stores/common'

interface AccountState {
  id: number | null
  status: string | null
  display_name: string | null
  handle_name: string | null
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
    display_name: null,
    handle_name: null,
    email: null,
    profile_path: null,
    created_at: null,
    errors: {},
  });

  function setData(data: AccountState): void {
    state.value = { ...data }
  }

  function resetData(): void {
    state.value = {
      id: null,
      status: null,
      display_name: null,
      handle_name: null,
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

  // ログイン処理
  const router = useRouter()
  const commonStore = useCommonStore()
  const login = async (payload: { email: string; password: string }): Promise<boolean> => {
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
        }, 3000)
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

  const logout = async(): Promise<boolean> => {
    try {
      await axios.post('/api/service_users/logout')
      return true
    } catch(error: unknown) {
      throw error
    }
  }

  return { state, setErrors, resetErrors, login, logout }
})
