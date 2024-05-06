import { ref } from 'vue';
import { defineStore } from 'pinia'

interface AppState {
  flashMessage: null | string
  apiLoading: boolean
}

export const useCommonStore = defineStore('common', () => {
  const state = ref(<AppState>{
    flashMessage: null, 
    apiLoading: false
  });

  function setFlashMessage(message: string): void {
    state.value.flashMessage = message
  }

  function clearFlashMessage(): void {
    state.value.flashMessage = null
  }

  function startApiLoading(): void {
    state.value.apiLoading = true
  }

  function stopApiLoading(): void {
    state.value.apiLoading = false
  }

  return { state, setFlashMessage, clearFlashMessage, startApiLoading, stopApiLoading };
})
