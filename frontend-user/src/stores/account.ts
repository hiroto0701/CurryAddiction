import axios, { AxiosError } from 'axios';
import { ref } from 'vue';
import { defineStore } from 'pinia';

interface AccountState {
  id: number | null;
  status: string | null;
  display_name: string | null;
  handle_name: string | null;
  email: string | null;
  profile_path: string | null;
  errors: Record<string, string[]>;
}

interface LoginErrorResponse {
  error: string;
}

interface ValidationErrorResponse {
  errors: Record<string, string[]>;
}

export const useAccountStore = defineStore('account', () => {
  const state = ref<AccountState>({
    id: null,
    status: null,
    display_name: null,
    handle_name: null,
    email: null,
    profile_path: null,
    errors: {},
  });

  function setData(data: AccountState): void {
    state.value = { ...data };
  }

  function resetData(): void {
    state.value = {
      id: null,
      status: null,
      display_name: null,
      handle_name: null,
      email: null,
      profile_path: null,
      errors: {},
    };
  }

  function setErrors(errors: Record<string, string[]>): void {
    state.value.errors = { ...errors };
  }

  function resetErrors(): void {
    state.value.errors = {};
  }

  const login = async (payload: { email: string; password: string }): Promise<boolean> => {
    try {
      await axios.get('/sanctum/csrf-cookie');
      const response = await axios.post('/login', {
        email: payload.email,
        password: payload.password,
      });
      setData(response.data.data);
      resetErrors();
      return true;
    } catch (error: unknown) {
      if (axios.isAxiosError(error)) {
        if (error.response) {
          const { response } = error;
          if (response.status === 422) {
            setErrors(response.data.errors as ValidationErrorResponse['errors']);
            return false;
          } else if (response.status === 401) {
            setErrors({ auth: ['メールアドレスまたはパスワードが違います。'] } as Record<string, string[]>);
            return false;
          }
        }
      }
      throw error;
    }
  };

  return { state, setErrors, resetErrors, login };
});
