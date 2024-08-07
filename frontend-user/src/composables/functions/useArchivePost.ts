import axios, { type AxiosResponse } from 'axios';

export const useArchivePost = () => {
  async function archivePost(postId: number): Promise<AxiosResponse> {
    return await axios.post(`/api/posts/${postId}/archives`);
  }

  return { archivePost };
};
