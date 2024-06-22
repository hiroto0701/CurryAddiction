import axios from 'axios'

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

interface PostsResponse {
  data: Post[]
  meta: PaginationStatus
}

export const usePosts = () => {
  async function fetchPostsList(params?: Record<string, any>): Promise<PostsResponse> {
    const response = await axios.get<PostsResponse>('/api/posts', { params })
    return response.data
  }

  async function fetchPostDetail(id: string): Promise<Post> {
    const response = await axios.get<{ data: Post }>(`/api/posts/${id}`)
    return response.data.data
  }

  return {
    fetchPostsList,
    fetchPostDetail
  }
}
