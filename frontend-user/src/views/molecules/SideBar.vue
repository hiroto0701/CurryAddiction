<script setup lang="ts">
import { type Component } from 'vue';
import { tv } from 'tailwind-variants';

interface Props {
  readonly position: 'left' | 'right';
  readonly menuComponent: Component;
}

const props = defineProps<Props>();
const isOpen = defineModel<boolean>();

function openMenu(): void {
  isOpen.value = true;
}

function closeMenu(): void {
  isOpen.value = false;
}

const sidebar = tv({
  base: 'fixed top-0 z-20 h-full transform overflow-y-auto bg-white p-5 transition-transform duration-300 ease-in-out',
  variants: {
    isOpen: {
      true: 'translate-x-0',
      false:
        props.position === 'left'
          ? '-translate-x-full md:sticky md:translate-x-0'
          : 'translate-x-full'
    },
    position: {
      left: 'left-0',
      right: 'right-0'
    }
  },
  defaultVariants: {
    isOpen: false,
    position: props.position
  }
});

const overlay = tv({
  base: 'fixed inset-0 z-10 bg-black bg-opacity-50',
  variants: {
    visibility: {
      hidden: 'hidden'
    }
  }
});
</script>

<template>
  <component :is="menuComponent" @toggle-menu="openMenu" />
  <aside :class="sidebar({ isOpen, position })" style="width: 258px">
    <slot :close="closeMenu" />
  </aside>

  <div v-if="isOpen" :class="overlay()" @click="closeMenu"></div>
</template>
