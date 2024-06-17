import axios from 'axios'
import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

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

interface SearchConditions {
  genre_id: number | null
  region_id: number | null
  prefecture_id: number | null
  store_name: string
  latitude: number | null
  longitude: number | null
}

export interface PaginationStatus {
  from: number | null
  to: number | null
  total: number | null
  current_page: number | null
  last_page: number | null
  per_page: number | null
}

interface SortStatus {
  column: string | null
  ascending: boolean
}

export const usePostStore = defineStore('post', () => {
  const searchConditions = ref<SearchConditions>({
    genre_id: null,
    region_id: null,
    prefecture_id: null,
    store_name: '',
    latitude: null,
    longitude: null
  })

  const paginationStatus = ref<PaginationStatus>({
    from: null,
    to: null,
    total: null,
    current_page: null,
    last_page: null,
    per_page: null
  })

  const sortStatus = ref<SortStatus>({
    column: null,
    ascending: false
  })

  const posts = ref<Post[]>([])
  const errors = ref<Record<string, string[]>>({})

  const getParameter = computed(() => {
    return {
      ...searchConditions.value,
      sort_attribute: sortStatus.value.column,
      sort_direction: sortStatus.value.ascending ? 'asc' : 'desc',
      page: paginationStatus.value.current_page,
      per_page: paginationStatus.value.per_page
    }
  })

  function setData(data: Post[]) {
    posts.value = data
    errors.value = {}
  }

  function setMeta(meta: PaginationStatus) {
    paginationStatus.value = {
      from: meta.from,
      to: meta.to,
      total: meta.total,
      current_page: meta.current_page,
      last_page: meta.last_page,
      per_page: meta.per_page
    }
  }

  function setCurrentPage(value: number) {
    paginationStatus.value.current_page = value
  }

  function setPerPage(value: number) {
    paginationStatus.value.per_page = value
  }

  function setErrors(errorData: Record<string, string[]>) {
    errors.value = { ...errorData }
  }

  function resetErrors(): void {
    errors.value = {}
  }

  function resetForms() {
    Object.keys(searchConditions.value).forEach((key) => {
      ;(searchConditions.value as any)[key] = null
    })
  }

  async function load(): Promise<void> {
    try {
      const response = await axios.get('/api/posts', { params: getParameter.value })
      setData(response.data.data)
      setMeta(response.data.meta)
    } catch (error: unknown) {
      let handled = false
      if (axios.isAxiosError(error) && error.response?.status === 422) {
        setErrors(error.response.data.errors)
        handled = true
      }
      throw { handled }
    }
  }

  return {
    posts,
    paginationStatus,
    setData,
    setErrors,
    resetErrors,
    resetForms,
    setMeta,
    setCurrentPage,
    setPerPage,
    load
  }
})
