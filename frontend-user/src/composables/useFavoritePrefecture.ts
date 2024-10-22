import axios, { type AxiosResponse } from 'axios';

export const useFavoritePrefecture = () => {
  async function favoritePrefecture(prefectureIds: number[]): Promise<AxiosResponse | null> {
    return await axios.post(`/api/prefectures/favorite`, {
      prefectures: prefectureIds
    });
  }

  return { favoritePrefecture };
};
