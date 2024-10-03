<script setup lang="ts">
import { MenuItem } from '@headlessui/vue';

const notifications = [
  {
    id: 1,
    text: '新しい通知1新しい通知1新しい通知1新しい通知1新しい通知1新しい通知1新しい通知1新しい通知1新しい通知1'
  },
  { id: 2, text: '新しい通知2' },
  { id: 3, text: '新しい通知3' },
  { id: 4, text: '新しい通知3' },
  { id: 5, text: '新しい通知3' },
  { id: 6, text: '新しい通知3' }
];
</script>
<template>
  <MenuItem
    class="border-t border-gray-200 px-4 py-3 first:border-none"
    v-for="notification in notifications"
    :key="notification.id"
    v-slot="{}"
  >
    <div class="flex justify-between">
      <img src="https://placehold.jp/150x150.png" class="h-8 w-8 rounded-full" alt="" />
      <a href="#" class="w-[calc(100%-50px)] font-body text-sm text-gray-500">
        {{ notification.text }}
      </a>
    </div>
  </MenuItem>
</template>
<style scoped></style>
