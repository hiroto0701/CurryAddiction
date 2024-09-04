import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import type { Genre } from '@/composables/types/genre';

interface GenreState {
  genres: Genre[];
  errors: Record<string, string[]>;
}

export const useCurryGenreStore = defineStore('curry_genre', () => {
  const state = ref<GenreState>({
    genres: [],
    errors: {}
  });

  function setData(genres: Genre[]) {
    state.value.genres = genres;
  }

  function setErrors(errors: Record<string, string[]>): void {
    state.value.errors = { ...errors };
  }

  function resetErrors(): void {
    state.value.errors = {};
  }

  async function fetchGenres(): Promise<void> {
    try {
      const response = await axios.get('/api/genres');

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
  }

  return {
    state,
    setData,
    setErrors,
    resetErrors,
    fetchGenres
  };
});
