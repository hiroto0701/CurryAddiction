import { ref } from 'vue';
import { defineStore } from 'pinia'

interface AppState {
  flashMessage: null | string
}

export const useCommonStore = defineStore('common', () => {
  const state = ref(<AppState>{
    flashMessage: null, 
  });

  function setFlashMessage(message: string): void {
    state.value.flashMessage = message
  }

  function clearFlashMessage(): void {
    state.value.flashMessage = null
  }

  return { state, setFlashMessage, clearFlashMessage };
})
