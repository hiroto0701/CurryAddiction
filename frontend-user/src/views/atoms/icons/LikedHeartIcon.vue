<script setup lang="ts">
interface Props {
  readonly liked: boolean
}

defineProps<Props>();
</script>
<template>
  <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'heart-beat': liked }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-transparent fill-red-400">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
  </svg>

  <span class="absolute w-0.5 h-0.5 bg-red-500 opacity-0 rounded-full" style="top: 5.5px; left: 12px;" :class="{ 'fade-outA': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-purple-300 opacity-0 rounded-full" style="top: 7px; left: 6px;" :class="{ 'fade-outB': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-green-300 opacity-0 rounded-full" style="top: 16px; left: 5px;" :class="{ 'fade-outC': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-blue-300 opacity-0 rounded-full" style="bottom: 10px; left: 9px;" :class="{ 'fade-outD': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-yellow-400 opacity-0 rounded-full" style="bottom: 5px; left: 9px;" :class="{ 'fade-outE': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-orange-500 opacity-0 rounded-full" style="bottom: 6px; right: 12px;" :class="{ 'fade-outF': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-purple-300 opacity-0 rounded-full" style="bottom: 9px; right: 8px;" :class="{ 'fade-outG': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-red-500 opacity-0 rounded-full" style="top: 14px; right: 4px;" :class="{ 'fade-outH': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-green-300 opacity-0 rounded-full" style="top: 9px; right: 6px;" :class="{ 'fade-outI': liked }"></span>
  <span class="absolute w-0.5 h-0.5 bg-orange-500 opacity-0 rounded-full" style="top: 5px; right: 10px;" :class="{ 'fade-outJ': liked }"></span>
</template>
<style scoped>
.fade-outA {
  animation: fadeOutA 0.5s;
}
.fade-outB {
  animation: fadeOutB 0.5s;
}
.fade-outC {
  animation: fadeOutC 0.5s;
}
.fade-outD {
  animation: fadeOutD 0.5s;
}
.fade-outE {
  animation: fadeOutE 0.5s;
}
.fade-outF {
  animation: fadeOutF 0.5s;
}
.fade-outG {
  animation: fadeOutG 0.5s;
}
.fade-outH {
  animation: fadeOutH 0.5s;
}
.fade-outI {
  animation: fadeOutI 0.5s;
}
.fade-outJ {
  animation: fadeOutJ 0.5s;
}

.heart-beat {
  animation: heartBeat 0.25s;
}

@keyframes heartBeat {
  50% {
    transform: scale(1.3);
  }
}

@keyframes fadeOutA {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(0, -3px) scale(1.3);
  }
}

@keyframes fadeOutB {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(-5px, -3px) scale(1.2);
  }
}

@keyframes fadeOutC {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(-5px, 0px) scale(1.4);
  }
}

@keyframes fadeOutD {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(-4px, 4px) scale(1.2);
  }
}

@keyframes fadeOutE {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(-2px, 5px) scale(1.2);
  }
}

@keyframes fadeOutF {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(5px, 5px) scale(1.1);
  }
}

@keyframes fadeOutG {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(8px, 5px) scale(1.4);
  }
}

@keyframes fadeOutH {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(5px, 0) scale(1.3);
  }
}

@keyframes fadeOutI {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(3px, -5px) scale(1.1);
  }
}

@keyframes fadeOutJ {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
  80% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
    transform: translate(3px, -3px) scale(1.3);
  }
}
</style>