<script setup lang="ts">
import MenuBarIcon from '@/views/atoms/icons/MenuBarIcon.vue';
import { tv } from 'tailwind-variants';

const emit = defineEmits<{
  (e: 'toggleMenu'): void;
}>();

const menuButton = tv({
  base: 'fixed right-3 top-8 z-10 flex h-12 w-12 items-center justify-center rounded-full border border-gray-300 bg-white opacity-70 shadow-sm duration-300',
  variants: {
    visibility: {
      hidden: 'md:hidden'
    }
  },
  defaultVariants: {
    visibility: 'hidden'
  },
  compoundVariants: [
    {
      visibility: 'hidden',
      class: 'md:hover:bg-slate-100 md:hover:opacity-100'
    }
  ]
});
</script>

<template>
  <button :class="menuButton()" aria-label="メニューを開く" @click="emit('toggleMenu')">
    <MenuBarIcon class="text-sumi-900" />
  </button>
</template>
