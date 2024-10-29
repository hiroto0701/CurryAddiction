<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue';
import { tv } from 'tailwind-variants';

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
  <BaseButton :class="button()" text="作成せずに終了する" />
</template>
