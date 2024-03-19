<script setup lang="ts">
import { onMounted, ref } from 'vue'
import ArrowTopIcon from '@/views/atoms/icons/ArrowTopIcon.vue'

const buttonActive = ref<boolean>(false)

let scroll: number = 0

const pageTop = (): void => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
}

const scrollWindow = (): void => {
  const top: number = 100;
  scroll = window.scrollY;
  
  if (top <= scroll) {
    buttonActive.value = true;
  } else {
    buttonActive.value = false;
  }
}

onMounted((): void => {
  window.addEventListener('scroll', scrollWindow);
});
</script>
<template>
  <transition name="opacity">
    <button 
      v-show="buttonActive"
      @click="pageTop"
      class="fixed right-14 bottom-9 flex justify-center items-center w-16 h-16 border border-gray-200 rounded-full hover:bg-slate-100 duration-300"
    >
    <ArrowTopIcon class="text-sumi-900" />
    </button>
  </transition>
</template>
<style scoped>
.opacity-enter{
  opacity: 0;
}
.opacity-enter-active{
  transition: opacity 1s;
}
.opacity-enter-to{
  opacity: 1;
}
.opacity-leave{
  opacity: 1;
}
.opacity-leave-active{
  transition: opacity .3s;
}
.opacity-leave-to{
  opacity: 0;
}
</style>