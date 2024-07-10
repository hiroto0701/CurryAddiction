import axios, { type AxiosResponse } from 'axios'

export const useDeletePost = () => {
  async function softDeletePost(postId: string): Promise<AxiosResponse> {
    return await axios.delete(`/api/posts/${postId}`)
  }

  async function hardDeletePost(postId: string): Promise<AxiosResponse> {
    return await axios.delete(`/api/posts/${postId}/force`)
  }

  return { softDeletePost, hardDeletePost }
}
