<script setup lang="ts">
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { Menu } from '@headlessui/vue';
import { useCommonStore } from '@/stores/common';
import type { Notification, PaginationStatus } from '@/types/notification';
import { useFetchNotifications } from '@/composables/functions/useFetchNotifications';
import NotificationButton from '@/views/molecules/buttons/NotificationButton.vue';
import NotificationList from '@/views/molecules/NotificationList.vue';

const commonStore = useCommonStore();
const { fetchNotificationList } = useFetchNotifications();

const notificationData = ref<Notification[]>([]);
const paginationData = ref<PaginationStatus | null>(null);
const refUnreadCount = ref<number>();

async function loadNotifications(page: number = 1) {
  try {
    const params = new URLSearchParams();
    params.append('page', page.toString());
    commonStore.startApiLoading();
    const { data, meta, unreadCount } = await fetchNotificationList(params);

    notificationData.value = [...notificationData.value, ...data];
    paginationData.value = meta;
    refUnreadCount.value = unreadCount;
  } catch (error) {
    console.error('通知の読み込みに失敗しました。:', error);
  } finally {
    commonStore.stopApiLoading();
  }
}

async function moreLoad(page: number | null) {
  if (page === null) return;
  await loadNotifications(page);
}

async function markAsRead() {
  if (!refUnreadCount) return;

  try {
    refUnreadCount.value = 0;
    await axios.post('/api/notifications/read');
  } catch (error) {
    console.error('通知に既読を付けられませんでした。:', error);
  }
}

onMounted(() => {
  loadNotifications();
});
</script>
<template>
  <Menu class="relative flex items-center justify-center" as="div" v-slot="{ open }">
    <NotificationButton
      class="relative flex h-8 w-8 items-center justify-center"
      @click="markAsRead"
    />
    <span
      class="absolute -right-1 top-0 flex h-4 w-fit items-center justify-center rounded-full bg-red-500 p-1 font-body text-mini text-white"
      v-if="refUnreadCount"
    >
      {{ refUnreadCount }}
    </span>
    <Transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <NotificationList
        class="absolute -right-32 top-9 z-10"
        :notificationData
        :paginationData
        :is-loading="commonStore.state.apiLoading"
        :disabled="commonStore.state.apiLoading"
        @load="moreLoad"
      />
    </Transition>
  </Menu>
</template>
