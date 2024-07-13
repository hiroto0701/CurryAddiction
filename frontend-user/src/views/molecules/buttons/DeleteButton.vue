<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
import LoadingSpinner from '@/views/atoms/LoadingSpinner.vue'

interface Props {
  readonly text: string
  readonly isLoading?: boolean
}
defineProps<Props>()
</script>
<template>
  <BaseButton class="button border border-red-200 p-3" :text :disabled="isLoading">
    <LoadingSpinner :is-loading />
  </BaseButton>
</template>
<style scoped>
.button {
  @apply flex gap-2 items-center text-red-400 bg-red-50;
}
.button:hover {
  @apply bg-red-100 border-red-300 text-red-500;
}
</style>
