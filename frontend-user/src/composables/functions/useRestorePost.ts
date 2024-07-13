import axios, { type AxiosResponse } from 'axios'

export const useRestorePost = () => {
  async function restorePost(postId: number): Promise<AxiosResponse> {
    return await axios.post(`/api/dashboard/trash/${postId}`)
  }

  return { restorePost }
}
