import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';

interface Genre {
  id: number;
  name: string;
}

interface GenreState {
  genres: Genre[];
  errors: Record<string, string[]>;
}

export const useCurryGenreStore = defineStore('curry_genre', () => {
  const state = ref<GenreState>({
    genres: [],
    errors: {}
  });

  const setData = (genres: Genre[]) => {
    state.value.genres = genres;
  };

  const setErrors = (errors: Record<string, string[]>): void => {
    state.value.errors = { ...errors };
  };

  const resetErrors = (): void => {
    state.value.errors = {};
  };

  const fetchGenres = async (): Promise<void> => {
    try {
      const response = await axios.get('/api/service_users/genres');

      if (response.status === 200) {
        setData(response.data.data);
        resetErrors();
      }
    } catch (error: unknown) {
      if (axios.isAxiosError(error)) {
        setErrors(error.response?.data || {});
        console.error('カレーのジャンルの取得に失敗しました。:', error);
      } else {
        setErrors({ default: [String(error)] });
      }
    }
  };

  return {
    state,
    setData,
    setErrors,
    resetErrors,
    fetchGenres
  };
});
