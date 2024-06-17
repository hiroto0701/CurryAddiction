import axios from 'axios'
import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { useCommonStore } from '@/stores/common'

interface PostFormState {
  id: string
  store_name: string
  comment: string
  genre_id: number | null
  post_img: string
  latitude: number | null
  longitude: number | null
  errors: Record<string, string[]>
}

export const usePostFormStore = defineStore('post_form', () => {
  const state = ref<PostFormState>({
    id: '',
    store_name: '',
    comment: '',
    genre_id: null,
    post_img: '',
    latitude: null,
    longitude: null,
    errors: {}
  })

  const router = useRouter()
  const commonStore = useCommonStore()

  function setData(data: PostFormState): void {
    state.value = data
  }

  function resetData(): void {
    state.value = {
      id: '',
      store_name: '',
      comment: '',
      genre_id: null,
      post_img: '',
      latitude: null,
      longitude: null,
      errors: {}
    }
  }

  function setErrors(errors: Record<string, string[]>): void {
    state.value.errors = { ...errors }
  }

  function resetErrors(): void {
    state.value.errors = {}
  }

  function validate(
    storeName: string,
    comment: string,
    genreId: number | undefined,
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
    if (postImg) {
      const allowedExtensions = ['png', 'jpeg', 'jpg']
      const extension = postImg.name.split('.').pop()?.toLowerCase()

      if (postImg.size > 10 * 1024 * 1024) {
        errors.post_img = ['カレーの画像のサイズは10MB以内にしてください']
      } else if (!extension || !allowedExtensions.includes(extension)) {
        errors.post_img = ['ファイルは.png .jpeg .jpg形式を指定してください。']
      }
    } else {
      errors.post_img = ['カレーの画像は必須項目です']
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

  async function load(id: string) {
    return new Promise((resolve, reject) => {
      axios
        .get(`/api/posts/${id}`)
        .then((res) => {
          setData(res.data.data)
          resolve(true)
        })
        .catch(() => reject())
    })
  }

  async function create(payload: {
    store_name: string
    comment?: string
    genre_id?: number
    post_img?: File
  }) {
    const formData = new FormData()
    formData.append('genre_id', payload.genre_id ? payload.genre_id.toString() : '')
    formData.append('region_id', '1')
    formData.append('prefecture_id', '2')
    formData.append('store_name', payload.store_name)
    if (payload.comment) {
      formData.append('comment', payload.comment)
    }
    if (payload.post_img) {
      formData.append('post_img', payload.post_img)
    }
    formData.append('latitude', '0.5')
    formData.append('longitude', '0.26567')

    const config = {
      headers: {
        'content-type': 'multipart/form-data',
        'X-HTTP-Method-Override': 'POST'
      }
    }

    try {
      commonStore.startApiLoading()
      await axios.post('/api/posts/', formData, config)

      await router.push({ name: 'Home' })
      commonStore.setFlashMessage('投稿しました')
      setTimeout(() => {
        commonStore.clearFlashMessage()
      }, 4000)
    } catch (error: unknown) {
      commonStore.setFlashMessage('投稿に失敗しました')
      setTimeout(() => {
        commonStore.clearFlashMessage()
      }, 4000)
    } finally {
      commonStore.stopApiLoading()
    }
  }

  return {
    state,
    setErrors,
    resetData,
    resetErrors,
    validate,
    load,
    create
  }
})
