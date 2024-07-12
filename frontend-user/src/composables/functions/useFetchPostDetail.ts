import axios from 'axios'
import type { Post } from '@/composables/types/post'

export const useFetchPostDetail = () => {
  async function fetchPostDetail(id: number): Promise<Post> {
    const response = await axios.get(`/api/posts/${id}`)
    return response.data.data
  }

  return { fetchPostDetail }
}
