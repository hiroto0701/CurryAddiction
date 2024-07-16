import axios, { type AxiosResponse } from 'axios'

export const useLikePost = () => {
  async function likePost(postId: number): Promise<AxiosResponse> {
    return await axios.post(`/api/posts/${postId}/likes`)
  }

  return { likePost }
}
