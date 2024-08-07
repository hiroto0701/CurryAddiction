import axios from 'axios';
import type { TrashResponse } from '@/composables/types/trash';

export const useFetchTrashPosts = () => {
  async function fetchTrashPostsList(params?: Record<string, any>): Promise<TrashResponse> {
    const response = await axios.get<TrashResponse>('/api/dashboard/trash', { params });
    return response.data;
  }

  return { fetchTrashPostsList };
};
