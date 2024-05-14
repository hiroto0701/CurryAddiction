import { ref } from 'vue';
import { defineStore } from 'pinia'

interface AppState {
  flashMessage: null | string
  apiLoading: boolean
  uploading: boolean
  loginLoading: boolean
}

export const useCommonStore = defineStore('common', () => {
  const state = ref(<AppState>{
    flashMessage: null, 
    apiLoading: false,
    uploading: false,
    loginLoading: false,
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

  function startUploading(): void {
    state.value.uploading = true
  }

  function stopUploading(): void {
    state.value.uploading = false
  }

  function startLoginLoading(): void {
    state.value.loginLoading = true
  }

  function stopLoginLoading(): void {
    state.value.loginLoading = false
  }

  return { 
    state,
    setFlashMessage, 
    clearFlashMessage, 
    startApiLoading, 
    stopApiLoading,
    startUploading, 
    stopUploading,
    startLoginLoading, 
    stopLoginLoading, 
  };
})
