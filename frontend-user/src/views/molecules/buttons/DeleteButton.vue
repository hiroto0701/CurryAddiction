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
  @apply flex items-center gap-2 bg-red-50 text-red-400;
}
.button:hover {
  @apply border-red-300 bg-red-100 text-red-500;
}
</style>
