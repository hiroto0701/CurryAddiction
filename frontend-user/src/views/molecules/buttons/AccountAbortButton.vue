<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
import { tv } from 'tailwind-variants'

const button = tv({
  base: 'flex items-center gap-2 border border-red-200 p-3 bg-red-50 text-red-400',
  variants: {
    hover: {
      true: 'hover:border-red-300 hover:bg-red-100 hover:text-red-500'
    },
    disabled: {
      true: 'opacity-50 cursor-not-allowed'
    }
  },
  defaultVariants: {
    hover: true
  }
})
</script>
<template>
  <BaseButton 
    :class="button()" 
    text="作成せずに終了する" 
  />
</template>
