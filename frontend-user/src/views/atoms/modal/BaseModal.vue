<script setup lang="ts">
import CrossIcon from '@/views/atoms/icons/CrossIcon.vue'

interface Props {
  closeModal: () => void
}

defineProps<Props>()
</script>
<template>
  <div
    class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-sumi-800 bg-opacity-50 z-10 backdrop-blur-sm"
    @click.self="closeModal"
  >
    <CrossIcon
      class="fixed top-6 right-6 inline-flex justify-center items-center text-white bg-gray-400 hover:bg-sumi-800 duration-300 rounded-full w-8 p-1 cursor-pointer"
      @click.self="closeModal"
    />
    <div class="modal z-20 bg-white flex flex-col gap-4 p-8 rounded-3xl">
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
