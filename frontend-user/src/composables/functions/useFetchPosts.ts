import axios from 'axios'
import type { PostsResponse } from '@/composables/types/post'

export const useFetchPosts = () => {
  async function fetchPostsList(params?: Record<string, any>): Promise<PostsResponse> {
    const response = await axios.get<PostsResponse>('/api/posts', { params })
    return response.data
  }

  return { fetchPostsList }
}
