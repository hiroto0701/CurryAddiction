// account_form.ts
import { ref } from 'vue';
import { defineStore } from 'pinia'
import { useAccountStore } from '@/stores/account'

interface AccountFormState {
  display_name: string | null
  errors: Record<string, string[]>
}

export const useAccountFormStore = defineStore('account_form', () => {
  const state = ref<AccountFormState>({
    display_name: null,
    errors: {},
  });

  function setErrors(errors: Record<string, string[]>): void {
    state.value.errors = { ...errors }
  }

  function resetErrors(): void {
    state.value.errors = {}
  }

  const accountStore = useAccountStore()

  function update(displayName: string | null) {
    state.value.display_name = displayName
    accountStore.updateDisplayName(displayName)
  }

  return { state, setErrors, resetErrors, update }
})