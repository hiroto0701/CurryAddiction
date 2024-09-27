<script setup lang="ts">
import { useCommonStore } from '@/stores/common';
import { useCurryGenreStore } from '@/stores/curry_genre';
import UpdateButton from '@/views/molecules/buttons/UpdateButton.vue';
import CancelButton from '@/views/molecules/buttons/CancelButton.vue';

interface Props {
  readonly isError: boolean;
}
defineProps<Props>();

const commonStore = useCommonStore();
const curryGenreStore = useCurryGenreStore();
const model = defineModel<string[]>();

const emits = defineEmits<{
  (e: 'update'): void;
  (e: 'cancel'): void;
}>();
</script>
<template>
  <div class="flex flex-col gap-5">
    <div class="grid grid-cols-2 gap-4">
      <div v-for="genre in curryGenreStore.state.genres" :key="genre.id" class="flex items-center">
        <input
          type="checkbox"
          class="mr-2 h-4 w-4"
          :id="'genre-' + genre.id"
          :value="genre.id"
          v-model="model"
        />
        <label :for="'genre-' + genre.id" class="font-body text-sm text-sumi-700">
          {{ genre.name }}
        </label>
      </div>
    </div>
    <div class="flex items-center gap-2">
      <UpdateButton
        class="inline-flex items-center justify-center px-4 py-3 text-sm"
        :is-loading="commonStore.state.apiLoading"
        :disabled="commonStore.state.apiLoading"
        @click="emits('update')"
      />
      <CancelButton
        class="inline-flex items-center justify-center px-4 py-3 text-sm"
        @click="emits('cancel')"
      />
    </div>
  </div>
</template>
