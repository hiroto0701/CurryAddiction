import axios, { type AxiosResponse } from 'axios';

export const useRestorePost = () => {
  async function restorePost(slug: string): Promise<AxiosResponse> {
    return await axios.post(`/api/dashboard/trash/${slug}`);
  }

  return { restorePost };
};
