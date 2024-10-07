<script setup lang="ts">
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue';
import MeatballMenuIcon from '@/views/atoms/icons/MeatballMenuIcon.vue';

interface Props {
  readonly isMine: boolean;
}
defineProps<Props>();

const emits = defineEmits<{
  (e: 'handlePost'): void;
}>();
</script>
<template>
  <Menu as="div" class="relative">
    <MenuButton
      class="relative flex aspect-square w-8 items-center justify-center rounded-full duration-300 md:hover:bg-gray-100"
      v-if="isMine"
      aria-label="投稿用メニューを開く"
    >
      <MeatballMenuIcon class="w-5" />
    </MenuButton>
    <Transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <MenuItems
        class="absolute right-[-.5rem] top-[1.7rem] z-10 mt-2 w-40 rounded-xl border border-gray-200 bg-white p-1 shadow-lg"
      >
        <MenuItem class="flex items-center justify-between rounded-lg p-2 text-sm">
          <button
            class="w-full bg-white font-body text-sm text-red-400 duration-300 md:hover:bg-red-50"
            @click="emits('handlePost')"
          >
            <TrashIcon />
            ごみ箱に入れる
          </button>
        </MenuItem>
      </MenuItems>
    </Transition>
  </Menu>
</template>
