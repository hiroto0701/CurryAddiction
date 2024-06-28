import axios, { type AxiosResponse } from 'axios'

export const useDeletePost = () => {
  async function softDeletePost(postId: string): Promise<AxiosResponse> {
    return await axios.delete(`/api/posts/${postId}`)
  }

  return { softDeletePost }
}
