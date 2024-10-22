import axios, { type AxiosResponse } from 'axios';

export const useDeletePost = () => {
  async function softDeletePost(slug: string): Promise<AxiosResponse> {
    return await axios.delete(`/api/posts/${slug}`);
  }

  async function hardDeletePost(slug: string): Promise<AxiosResponse> {
    return await axios.delete(`/api/dashboard/trash/${slug}`);
  }

  return { softDeletePost, hardDeletePost };
};
