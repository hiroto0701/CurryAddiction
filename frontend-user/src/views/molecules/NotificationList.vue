<script setup lang="ts">
import { MenuItems } from '@headlessui/vue';
import type { Notification, PaginationStatus } from '@/types/notification';
import NotificationItem from '@/views/molecules/NotificationItem.vue';

interface Props {
  readonly notificationData: Notification[];
  readonly paginationData: PaginationStatus | null;
}
defineProps<Props>();
</script>
<template>
  <MenuItems
    class="max-h-80 w-72 overflow-y-scroll rounded bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5"
  >
    <NotificationItem
      v-for="notification in notificationData"
      :key="notification.id"
      :notification="notification"
    />
  </MenuItems>
</template>
