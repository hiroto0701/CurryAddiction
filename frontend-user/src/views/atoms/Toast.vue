<template>
  <div
    class="toast fixed left-1/2 top-20 flex w-fit -translate-x-1/2 items-center gap-3 rounded-xl p-3"
    role="alert"
  >
    <slot />
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
    opacity: 0.9;
    transform: translate(-50%, 0);
  }
  90% {
    opacity: 0.9;
    transform: translate(-50%, 0);
  }
  100% {
    opacity: 0;
    transform: translate(-50%, -30px);
  }
}
</style>
