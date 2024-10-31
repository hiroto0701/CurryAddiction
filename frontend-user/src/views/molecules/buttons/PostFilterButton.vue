<script setup lang="ts">
import { useAccountStore } from '@/stores/account';
import FilterIcon from '@/views/atoms/icons/FilterIcon.vue';

const accountStore = useAccountStore();

const emit = defineEmits<{
  (e: 'toggleMenu'): void;
}>();
</script>

<template>
  <button
    class="group relative mb-5 ml-auto mr-0 flex aspect-square w-9 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100"
    aria-label="メニューを開く"
    @click="emit('toggleMenu')"
  >
    <FilterIcon class="relative w-6 text-sumi-600 group-hover:text-sumi-900" />
    <div
      class="absolute right-0 top-0 h-2 w-2 rounded-full bg-red-400"
      v-if="
        accountStore.state.favorite_genres.length > 0 ||
        accountStore.state.favorite_prefectures.length > 0
      "
    ></div>
  </button>
</template>
