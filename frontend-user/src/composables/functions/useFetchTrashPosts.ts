import axios from 'axios'
import type { PostsResponse } from '@/composables/types/post'

export const useFetchTrashPosts = () => {
  async function fetchTrashPostsList(params?: Record<string, any>): Promise<PostsResponse> {
    const response = await axios.get<PostsResponse>('/api/dashboard/trash', { params })
    return response.data
  }

  return { fetchTrashPostsList }
}
