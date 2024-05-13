<script setup lang="ts">
interface Props {
  src: string;
}

defineProps<Props>()
</script>
<template>
  <div class="w-full h-52 cursor-pointer duration-300 hover:opacity-80">
    <img class="w-full h-full object-cover" :src="src" alt="カレーの画像" >
  </div>
</template>
