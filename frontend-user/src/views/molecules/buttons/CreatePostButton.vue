<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue';
import { tv } from 'tailwind-variants';

const button = tv({
  base: 'flex cursor-pointer items-center justify-center rounded-full bg-sky-500 font-body text-white',
  variants: {
    hover: {
      true: 'hover:border-transparent hover:bg-sky-400 hover:opacity-80'
    }
  },
  defaultVariants: {
    hover: true
  }
});
</script>
<template>
  <BaseButton type="button" :class="button()" text="投稿する" />
</template>
