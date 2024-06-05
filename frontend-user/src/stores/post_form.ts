import axios from 'axios'
import { ref } from 'vue'
import { defineStore } from 'pinia'
// import { useRouter } from 'vue-router'
// import { useAccountStore } from '@/stores/account'
// import { useCommonStore } from '@/stores/common'

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

  function validate(
    storeName: string,
    comment: string,
    genreId: number,
    postImg: File | undefined,
    latitude: number | null,
    longitude: number | null
  ): boolean {
    const errors: Record<string, string[]> = {}

    // 店名のバリデーション
    if (!storeName) {
      errors.store_name = ['店名は必須項目です']
    } else if (storeName.length > 30) {
      errors.store_name = ['店名は30文字以内で入力してください']
    }

    // 感想のバリデーション
    if (comment && comment.length > 140) {
      errors.comment = ['感想 は140文字以内で入力してください']
    }

    // ジャンルIDのバリデーション
    if (!genreId) {
      errors.genre_id = ['カレーのジャンルは必須項目です']
    }

    // 投稿画像のバリデーション
    const allowedExtensions: Array<string> = ['png', 'jpeg', 'jpg']
    const extension: string | undefined = postImg?.name?.split('.')?.pop()?.toLowerCase()

    if (!postImg) {
      errors.post_img = ['カレーの画像は必須項目です']
    } else if (postImg.size > 10 * 1024 * 1024) {
      errors.post_img = ['カレーの画像のサイズは10MB以内にしてください']
    } else if (postImg && !allowedExtensions?.includes(extension)) {
      errors.post_img = ['ファイルは.png .jpeg .jpg形式を指定してください。']
    }

    // 緯度経度のバリデーション
    if (!latitude || !longitude) {
      errors.location = ['位置情報は必須項目です']
    }

    if (Object.keys(errors).length > 0) {
      setErrors(errors)
      return false
    }

    resetErrors()
    return true
  }

  async function create(payload: {
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
    validate,
    create
  }
})
