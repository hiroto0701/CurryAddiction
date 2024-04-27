<script setup lang="ts">
import { Menu, MenuButton, MenuItems } from '@headlessui/vue'
import ChevronIcon from '@/views/atoms/icons/ChevronIcon.vue'

interface Props {
  readonly username: null | string
}

defineProps<Props>()
</script>
<template>
  <Menu as="div" class="relative ml-3">
    <MenuButton class="flex items-center gap-x-0.5 text-sm text-slate-600 hover:text-sumi-900 font-body">
      {{ username }}
      <ChevronIcon />
    </MenuButton>
    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5">
       <slot />
      </MenuItems>
    </transition>
  </Menu>
</template>
