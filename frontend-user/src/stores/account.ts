import axios from 'axios'
import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

interface AccountState {
  id: number | null;
  status: string | null;
  display_name: string | null;
  handle_name: string | null;
  email: string | null;
  profile_path: string | null;
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

  function setData(data: string[]) {
    state.value.id = data.id;
    state.value.status = data.status;
    state.value.display_name = data.display_name;
    state.value.handle_name = data.handle_name;
    state.value.email = data.email;
    state.value.profile_path = data.profile_path;
  }

  function resetData() {
    state.value.id = null;
    state.value.status = null;
    state.value.display_name = null;
    state.value.handle_name = null;
    state.value.email = null;
    state.value.profile_path = null;
  }

  function setErrors(errors) {
    state.value.errors = { ...errors };
  }
  
  function resetErrors() {
    state.value.errors = {};
  }

  const async function login() {
    resetErrors()
  }

  return { state, login}
})
