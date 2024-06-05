<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
</script>
<template>
  <BaseButton type="button" class="button" text="投稿する" />
</template>
<style scoped>
.button {
  @apply rounded-full font-body flex items-center justify-center cursor-pointer text-white bg-sky-500;
}
.button:hover {
  @apply opacity-80 bg-sky-400 border-transparent;
}
</style>
