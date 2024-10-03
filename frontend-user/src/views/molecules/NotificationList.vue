<script setup lang="ts">
import { MenuItems } from '@headlessui/vue';
import NotificationItem from '@/views/atoms/NotificationItem.vue';
</script>
<template>
  <MenuItems
    class="max-h-80 w-60 overflow-y-scroll rounded bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5"
  >
    <NotificationItem />
  </MenuItems>
</template>
