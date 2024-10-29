<script setup lang="ts">
import CrossIcon from '@/views/atoms/icons/CrossIcon.vue';

const emits = defineEmits<{
  (e: 'close'): void;
}>();
</script>

<template>
  <button
    class="group flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-200"
    @click="emits('close')"
  >
    <CrossIcon class="w-5 text-sumi-600 group-hover:text-sumi-900" />
  </button>
</template>
