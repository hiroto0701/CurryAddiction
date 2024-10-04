<script setup lang="ts">
import { Menu } from '@headlessui/vue';
import { ref } from 'vue';
import { useCommonStore } from '@/stores/common';
import type { Notification, PaginationStatus } from '@/types/notification';
import { useFetchNotifications } from '@/composables/functions/useFetchNotifications';
import NotificationButton from '@/views/molecules/buttons/NotificationButton.vue';
import NotificationList from '@/views/molecules/NotificationList.vue';

const commonStore = useCommonStore();
const { fetchNotificationList } = useFetchNotifications();

const notificationData = ref<Notification[]>([]);
const paginationData = ref<PaginationStatus | null>(null);

await loadNotifications();

async function loadNotifications(page: number = 1) {
  try {
    const params = new URLSearchParams();
    params.append('page', page.toString());
    commonStore.startApiLoading();
    const { data, meta } = await fetchNotificationList(params);

    notificationData.value = [...notificationData.value, ...data];
    paginationData.value = meta;
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
</script>
<template>
  <Menu class="relative flex items-center justify-center" as="div" v-slot="{ open }">
    <NotificationButton class="flex h-8 w-8 items-center justify-center" />
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
