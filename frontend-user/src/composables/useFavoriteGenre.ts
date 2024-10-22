import axios, { type AxiosResponse } from 'axios';

export const useFavoriteGenre = () => {
  async function favoriteGenre(genreIds: number[]): Promise<AxiosResponse | null> {
    return await axios.post(`/api/genres/favorite`, {
      genres: genreIds
    });
  }

  return { favoriteGenre };
};
