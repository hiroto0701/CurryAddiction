<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue';
import LoadingSpinner from '@/views/atoms/LoadingSpinner.vue';

interface Props {
  readonly text: string;
  readonly isLoading?: boolean;
}
defineProps<Props>();
</script>
<template>
  <BaseButton
    class="flex w-full items-center justify-center gap-2 rounded-full border px-3.5 py-2.5 text-sm text-sumi-900 hover:border-slate-300 hover:bg-slate-100"
    :text
  >
    <LoadingSpinner :is-loading />
  </BaseButton>
</template>
