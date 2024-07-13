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
  <BaseButton
    class="flex gap-2 items-center border border-gray-300 text-sumi-900 p-3"
    type="submit"
    :text
    :disabled="isLoading"
  >
    <LoadingSpinner :is-loading />
  </BaseButton>
</template>
