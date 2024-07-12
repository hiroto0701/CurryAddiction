import axios, { type AxiosResponse } from 'axios'

export const useDeletePost = () => {
  async function softDeletePost(postId: number): Promise<AxiosResponse> {
    return await axios.delete(`/api/posts/${postId}`)
  }

  async function hardDeletePost(postId: number): Promise<AxiosResponse> {
    return await axios.delete(`/api/dashboard/trash/${postId}`)
  }

  return { softDeletePost, hardDeletePost }
}
