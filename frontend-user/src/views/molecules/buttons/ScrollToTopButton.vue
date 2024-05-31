<script setup lang="ts">
import { onMounted, ref } from 'vue'
import ArrowTopIcon from '@/views/atoms/icons/ArrowTopIcon.vue'
import TopTooltip from '@/views/molecules/tooltips/TopTooltip.vue'

const buttonVisibility = ref<boolean>(false);

let scroll: number = 0

function pageTop(): void {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
}

function scrollWindow(): void {
  const top: number = 100;
  scroll = window.scrollY;
  
  buttonVisibility.value = top <= scroll;
}

onMounted((): void => {
  window.addEventListener('scroll', scrollWindow);
});
</script>
<template>
  <transition name="opacity">
    <div class="fixed right-14 max-md:right-3 bottom-9" v-show="buttonVisibility">
      <TopTooltip text="ページトップへ" position="top">
        <button 
          v-show="buttonVisibility"
          @click="pageTop"
          class="peer flex justify-center items-center w-16 max-sm:w-14 aspect-square border border-gray-300 shadow-sm rounded-full bg-white opacity-70 hover:bg-slate-100 hover:opacity-100 duration-300"
        >
          <ArrowTopIcon class="text-sumi-900" />
        </button>
      </TopTooltip>
    </div>
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
