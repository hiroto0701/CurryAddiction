<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
import LoadingSpinner from '@/views/atoms/LoadingSpinner.vue'

interface Props {
  readonly isLoading?: boolean
}
defineProps<Props>()
</script>
<template>
  <BaseButton class="button border border-red-200 p-3" text="ごみ箱に入れる">
    <LoadingSpinner :is-loading />
  </BaseButton>
</template>
<style scoped>
.button {
  @apply text-red-300 bg-red-50;
}
.button:hover {
  @apply bg-red-100 border-red-300 text-red-400;
}
</style>
