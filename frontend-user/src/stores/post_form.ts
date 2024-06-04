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

  function create(payload: {
    store_name: string
    comment?: string
    genre_id: number
    post_img?: File
  }) {
    const formData = new FormData()
    formData.append('genre_id', '1')
    formData.append('region_id', '1')
    formData.append('prefecture_id', '2')
    formData.append('store_name', payload.store_name)
    formData.append('comment', payload.comment)
    formData.append('latitude', '0.5')
    formData.append('longitude', '0.26567')
    formData.append('post_img', payload.post_img)
    const config = {
      headers: {
        'content-type': 'multipart/form-data',
        'X-HTTP-Method-Override': 'POST'
      }
    }

    axios.post('/api/posts/', formData, config)
  }

  return {
    state,
    setErrors,
    resetData,
    resetErrors,
    create
  }
})
