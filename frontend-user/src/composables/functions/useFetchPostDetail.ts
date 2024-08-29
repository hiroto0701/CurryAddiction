import axios from 'axios';
import type { Post } from '@/composables/types/post';

export const useFetchPostDetail = () => {
  async function fetchPostDetail(slug: string): Promise<Post> {
    const response = await axios.get(`/api/posts/${slug}`);
    return response.data.data;
  }

  return { fetchPostDetail };
};
