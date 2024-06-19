import axios from 'axios'
import { ref } from 'vue'

export interface Post {
  id: string
  genre_id: number | null
  region_id: number | null
  prefecture_id: number | null
  store_name: string
  comment: string
  post_img: string
  latitude: number | null
  longitude: number | null
  posted_at: string
  errors: Record<string, string[]>
}

export interface PaginationStatus {
  from: number | null
  to: number | null
  total: number | null
  current_page: number | null
  last_page: number | null
  per_page: number | null
}

export const usePosts = () => {
  const posts = ref<Post[]>([])
  const paginationStatus = ref<PaginationStatus>({
    from: null,
    to: null,
    total: null,
    current_page: null,
    last_page: null,
    per_page: null
  })
  const errors = ref<Record<string, string[]>>({})

  async function fetchPostLists(params: Record<string, any>) {
    try {
      const response = await axios.get('/api/posts', { params })
      posts.value = response.data.data
      paginationStatus.value = response.data.meta
    } catch (error: unknown) {
      if (axios.isAxiosError(error) && error.response?.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const fetchPostDetail = async (id: string) => {
    try {
      const response = await axios.get(`/api/posts/${id}`)
      posts.value = [response.data.data]
    } catch (error: unknown) {
      if (axios.isAxiosError(error) && error.response?.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  return { posts, paginationStatus, errors, fetchPostLists, fetchPostDetail }
}
