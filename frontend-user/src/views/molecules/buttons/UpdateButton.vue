<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
import LoadingSpinner from '@/views/atoms/LoadingSpinner.vue'

interface Props {
  readonly isLoading?: boolean
}
defineProps<Props>()
</script>
<template>
  <BaseButton
    class="flex items-center gap-2 border border-gray-300 text-sumi-900 hover:border-slate-300 hover:bg-slate-100"
    type="submit"
    text="更新する"
  >
    <LoadingSpinner :is-loading />
  </BaseButton>
</template>
