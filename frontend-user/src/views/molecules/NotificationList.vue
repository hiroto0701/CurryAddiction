<script setup lang="ts">
import { MenuItems } from '@headlessui/vue';
import type { Notification, PaginationStatus } from '@/types/notification';
import NotificationItem from '@/views/molecules/NotificationItem.vue';
import NotificationLoadButton from '@/views/molecules/buttons/NotificationLoadButton.vue';
import EmptyNotification from '@/views/molecules/EmptyNotification.vue';

interface Props {
  readonly notificationData: Notification[];
  readonly paginationData: PaginationStatus | null;
  readonly isLoading?: boolean;
}
defineProps<Props>();

const emit = defineEmits<{
  (e: 'load', nextPage: number | null): number;
}>();
</script>

<template>
  <MenuItems
    class="flex w-72 flex-col items-center justify-center rounded bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5"
  >
    <div class="max-h-80 overflow-y-auto" v-if="notificationData.length > 0">
      <NotificationItem
        v-for="notification in notificationData"
        :key="notification.id"
        :notification="notification"
      />
      <div class="px-4 py-3" v-if="paginationData?.has_more_pages">
        <NotificationLoadButton
          text="さらに読み込む"
          :is-loading
          :disabled="isLoading"
          @click="emit('load', paginationData?.next_page)"
        />
      </div>
    </div>
    <EmptyNotification v-else />
  </MenuItems>
</template>
