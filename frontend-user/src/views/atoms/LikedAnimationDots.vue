<template>
  <div>
    <span class="bubble01 absolute h-0.5 w-0.5 rounded-full bg-red-500 opacity-0"></span>
    <span class="bubble02 absolute h-0.5 w-0.5 rounded-full bg-purple-300 opacity-0"></span>
    <span class="bubble03 absolute h-0.5 w-0.5 rounded-full bg-green-300 opacity-0"></span>
    <span class="bubble04 absolute h-0.5 w-0.5 rounded-full bg-blue-300 opacity-0"></span>
    <span class="bubble05 absolute h-0.5 w-0.5 rounded-full bg-yellow-400 opacity-0"></span>
    <span class="bubble06 absolute h-0.5 w-0.5 rounded-full bg-orange-500 opacity-0"></span>
    <span class="bubble07 absolute h-0.5 w-0.5 rounded-full bg-purple-300 opacity-0"></span>
    <span class="bubble08 absolute h-0.5 w-0.5 rounded-full bg-red-500 opacity-0"></span>
    <span class="bubble09 absolute h-0.5 w-0.5 rounded-full bg-green-300 opacity-0"></span>
    <span class="bubble10 absolute h-0.5 w-0.5 rounded-full bg-orange-500 opacity-0"></span>
  </div>
</template>

<style scoped>
.bubble01 {
  animation: fadeOut01 0.5s;
  top: 5.5px;
  left: 12px;
}
.bubble02 {
  animation: fadeOut02 0.5s;
  top: 7px;
  left: 6px;
}
.bubble03 {
  animation: fadeOut03 0.5s;
  top: 16px;
  left: 5px;
}
.bubble04 {
  animation: fadeOut04 0.5s;
  bottom: 10px;
  left: 9px;
}
.bubble05 {
  animation: fadeOut05 0.5s;
  bottom: 5px;
  left: 9px;
}
.bubble06 {
  animation: fadeOut06 0.5s;
  bottom: 6px;
  right: 12px;
}
.bubble07 {
  animation: fadeOut07 0.5s;
  bottom: 9px;
  right: 8px;
}
.bubble08 {
  animation: fadeOut08 0.5s;
  top: 14px;
  right: 4px;
}
.bubble09 {
  animation: fadeOut09 0.5s;
  top: 9px;
  right: 6px;
}
.bubble10 {
  animation: fadeOut10 0.5s;
  top: 5px;
  right: 10px;
}

@keyframes fadeOut01 {
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

@keyframes fadeOut02 {
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

@keyframes fadeOut03 {
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

@keyframes fadeOut04 {
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

@keyframes fadeOut05 {
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

@keyframes fadeOut06 {
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

@keyframes fadeOut07 {
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

@keyframes fadeOut08 {
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

@keyframes fadeOut09 {
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

@keyframes fadeOut10 {
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
