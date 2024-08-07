<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue';
import LoadingSpinner from '@/views/atoms/LoadingSpinner.vue';
import { tv } from 'tailwind-variants';

interface Props {
  readonly text: string;
  readonly isLoading?: boolean;
}
defineProps<Props>();

const button = tv({
  base: 'flex items-center gap-2 border border-red-200 bg-red-50 p-3 text-red-400',
  variants: {
    hover: {
      true: 'hover:border-red-300 hover:bg-red-100 hover:text-red-500'
    },
    disabled: {
      true: 'cursor-not-allowed opacity-50'
    }
  },
  defaultVariants: {
    hover: true
  }
});
</script>
<template>
  <BaseButton :class="button({ disabled: isLoading })" :text="text" :disabled="isLoading">
    <LoadingSpinner :is-loading="isLoading" />
  </BaseButton>
</template>
