<script setup lang="ts">
import CheckIcon from '@/views/atoms/icons/CheckIcon.vue'

</script>
<template>
  <div class="toast w-fit p-3 fixed top-20 left-1/2 -translate-x-1/2 flex items-center gap-3 bg-emerald-500 rounded-xl">
    <CheckIcon class="w-7 text-emerald-500 bg-white rounded-full" />
    <p class="font-body text-sm text-white">ログインしました</p>
  </div>
</template>
<style scoped>
.toast {
  animation-name: slide-in;
  animation-duration: 3s;
  animation-iteration-count: 1;
  animation-fill-mode: forwards;
}

@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translate(-50%, -30px);
  }
  10% {
    opacity: 1;
    transform: translate(-50%, 0);
  }
  90% {
    opacity: 1;
    transform: translate(-50%, 0);
  }
  100% {
    opacity: 0;
    transform: translate(-50%, -30px);
  }
}
</style>