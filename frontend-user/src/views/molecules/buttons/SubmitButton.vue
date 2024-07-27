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
    class="flex items-center gap-2 border border-gray-300 p-3 text-sumi-900"
    type="submit"
    :text
  >
    <LoadingSpinner :is-loading />
  </BaseButton>
</template>
