<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
</script>
<template>
  <BaseButton class="button border border-red-200 p-3" text="作成せずに終了する" />
</template>
<style scoped>
.button {
  @apply bg-red-50 text-red-300;
}
.button:hover {
  @apply border-red-300 bg-red-100 text-red-400;
}
</style>
