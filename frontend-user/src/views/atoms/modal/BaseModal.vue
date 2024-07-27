<script setup lang="ts">
import CrossIcon from '@/views/atoms/icons/CrossIcon.vue'

interface Props {
  readonly closeModal: () => void
}

defineProps<Props>()
</script>
<template>
  <div
    class="fixed left-0 top-0 z-10 flex h-full w-full items-center justify-center bg-sumi-800 bg-opacity-50 backdrop-blur-sm"
    @click.self="closeModal"
  >
    <CrossIcon
      class="fixed right-6 top-6 inline-flex w-8 cursor-pointer items-center justify-center rounded-full bg-gray-400 p-1 text-white duration-300 hover:bg-sumi-800"
      @click.self="closeModal"
    />
    <div class="modal z-20 flex max-w-96 flex-col gap-4 rounded-3xl bg-white p-8">
      <slot />
    </div>
  </div>
</template>
<style scoped>
.modal {
  animation-name: slide-in;
  animation-duration: 3s;
  animation-iteration-count: 1;
  animation-fill-mode: forwards;
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
