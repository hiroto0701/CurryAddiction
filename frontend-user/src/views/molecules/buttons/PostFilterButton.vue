<script setup lang="ts">
import FilterIcon from '@/views/atoms/icons/FilterIcon.vue';

const emit = defineEmits<{
  (e: 'toggleMenu'): void;
}>();
</script>
<template>
  <button
    class="group absolute -top-12 right-0 flex aspect-square w-9 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100"
    aria-label="メニューを開く"
    @click="emit('toggleMenu')"
  >
    <FilterIcon class="w-6 text-sumi-600 group-hover:text-sumi-900" />
  </button>
</template>
