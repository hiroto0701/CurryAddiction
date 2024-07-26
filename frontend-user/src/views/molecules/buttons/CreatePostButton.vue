<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
</script>
<template>
  <BaseButton type="button" class="button" text="投稿する" />
</template>
<style scoped>
.button {
  @apply flex cursor-pointer items-center justify-center rounded-full bg-sky-500 font-body text-white;
}
.button:hover {
  @apply border-transparent bg-sky-400 opacity-80;
}
</style>
