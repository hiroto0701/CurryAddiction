<script setup lang="ts">
import CrossIcon from '@/views/atoms/icons/CrossIcon.vue';

interface Props {
  readonly closeModal: () => void;
}

defineProps<Props>();
</script>
<template>
  <div
    class="fixed left-0 top-0 z-40 flex h-full w-full items-center justify-center bg-sumi-800 bg-opacity-50 backdrop-blur-sm"
    @click.self="closeModal"
  >
    <button
      class="fixed right-6 top-6 inline-flex items-center justify-center rounded-full bg-gray-400 duration-300 hover:bg-sumi-800"
      @click="closeModal"
    >
      <CrossIcon class="w-8 p-1 text-white" />
    </button>
    <div class="modal z-40 flex max-w-96 flex-col gap-4 rounded-3xl bg-white p-8">
      <slot />
    </div>
  </div>
</template>
<style scoped>
.modal {
  animation-name: slide-in;
  animation-duration: 3s;
  animation-iteration-count: 1;
}
@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translate(0, 30px);
  }
  10% {
    opacity: 0.9;
    transform: translate(0, 0);
  }
  100% {
    opacity: 1;
    transform: translate(0, 0);
  }
}
</style>
