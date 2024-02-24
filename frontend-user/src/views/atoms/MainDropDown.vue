<script setup lang="ts">
import { Menu, MenuButton, MenuItems } from '@headlessui/vue'
import ChevronIcon from '@/views/atoms/icons/ChevronIcon.vue'
// Todo
// ユーザ名の部分はpropsで定義する
// ドロップダウンの選択肢はslotにして、コンポーネントによって中身を変えたい
const props = defineProps({
  username: String
});
</script>
<template>
  <Menu as="div" class="relative ml-3">
    <div>
      <MenuButton class="flex items-center gap-x-0.5 text-sm text-slate-600 hover:text-main">
        {{ props.username }}
        <ChevronIcon />
      </MenuButton>
    </div>
    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
       <slot />
      </MenuItems>
    </transition>
  </Menu>
</template>