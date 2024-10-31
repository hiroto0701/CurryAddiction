<script setup lang="ts">
import { computed } from 'vue';
import type { Genre } from '@/types/genre';
import { useCurryGenreStore } from '@/stores/curry_genre';
import GenreIcon from '@/views/atoms/icons/GenreIcon.vue';

interface Props {
  readonly genreId: number;
}

const props = defineProps<Props>();
const curryGenreStore = useCurryGenreStore();

const genreName = computed<string>(() => {
  const genre: Genre | undefined = curryGenreStore.state.genres.find((g) => g.id === props.genreId);
  return genre?.name || 'その他';
});
</script>

<template>
  <div class="flex h-fit items-center gap-2.5">
    <GenreIcon />
    <h2 class="select-none truncate font-body leading-relaxed">
      {{ genreName }}
    </h2>
  </div>
</template>
