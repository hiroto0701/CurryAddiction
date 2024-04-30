<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
import CrossIcon from '@/views/atoms/icons/CrossIcon.vue'

interface Props {
  show: boolean
  title: string
  description: string
  confirmButtonText: string
  confirmAction: Function
  cancelButtonText: string
}

const props = withDefaults(defineProps<Props>(), {
  show: false,
  title: '',
  description: '',
  confirmButtonText: '',
  confirmAction: () => {},
  cancelButtonText: ''
})

const emit = defineEmits(['close'])

const closeModal = (): void => {
  emit('close')
  document.body.style.overflow = 'auto'
}
</script>

<template>
  <div
    class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-sumi-800 bg-opacity-50 z-10 backdrop-blur-sm"
    v-show="show"
    @click.self="closeModal"
  >
    <CrossIcon
      class="fixed top-6 right-6 inline-flex justify-center items-center text-white bg-gray-400 hover:bg-sumi-800 duration-300 rounded-full w-8 p-1 cursor-pointer"
      @click.self="closeModal"
    />
    <div class="modal z-20 bg-white flex flex-col gap-4 p-8 rounded-lg">
      <p class="font-body w-fit mx-auto text-sumi-900 text-lg">{{ title }}</p>
      <p class="font-body w-fit mx-auto text-sumi-500 text-sm">{{ description }}</p>
      <BaseButton
        class="border border-gray-300 hover:opacity-70 hover:bg-slate-50 duration-300 p-3"
        :text="confirmButtonText"
        @click.self="confirmAction"
      />
      <BaseButton
        class="border border-gray-300 bg-sumi-200 p-3 hover:opacity-70 duration-300"
        :text="cancelButtonText"
        @click.self="closeModal"
      />
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