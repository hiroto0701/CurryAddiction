<script setup lang="ts">
import { useCommonStore } from '@/stores/common';
import { useCurryGenreStore } from '@/stores/curry_genre';
import UpdateButton from '@/views/molecules/buttons/UpdateButton.vue';
import CancelButton from '@/views/molecules/buttons/CancelButton.vue';

const commonStore = useCommonStore();
const curryGenreStore = useCurryGenreStore();
const model = defineModel<number[]>();

const emits = defineEmits<{
  (e: 'update'): void;
  (e: 'cancel'): void;
}>();
</script>
<template>
  <div class="flex flex-col gap-5">
    <div class="grid grid-cols-2 gap-4">
      <div
        v-for="genre in curryGenreStore.state.genres"
        :key="genre.id"
        class="flex w-fit cursor-pointer items-center"
      >
        <input
          type="checkbox"
          class="mr-2 h-4 w-4 cursor-pointer"
          :id="'genre-' + genre.id"
          :value="genre.id"
          v-model="model"
          :checked="model?.includes(genre.id as number)"
        />
        <label :for="'genre-' + genre.id" class="cursor-pointer font-body text-sm text-sumi-700">
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
