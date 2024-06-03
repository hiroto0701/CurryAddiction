import axios from 'axios'
import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { useAccountStore } from '@/stores/account'
import { useCommonStore } from '@/stores/common'

interface PostFormState {
  store_name: string
  genre_id: number | null
  post_img: string
  latitude: number | null
  longitude: number | null
  errors: Record<string, string[]>
}

export const usePostFormStore = defineStore('post_form', () => {
  const state = ref<PostFormState>({
    store_name: '',
    genre_id: null,
    post_img: '',
    latitude: null,
    longitude: null,
    errors: {}
  })

  function setErrors(errors: Record<string, string[]>): void {
    state.value.errors = { ...errors }
  }

  function resetData(): void {
    state.value = {
      store_name: '',
      genre_id: null,
      post_img: '',
      latitude: null,
      longitude: null,
      errors: {}
    }
  }

  function resetErrors(): void {
    state.value.errors = {}
  }

  return {
    state,
    setErrors,
    resetData,
    resetErrors
  }
})
