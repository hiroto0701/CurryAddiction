<script setup lang="ts">
import NotificationUserNameLink from '@/views/atoms/notificationItems/NotificationUserNameLink.vue';
import NotificationStoreNameLink from '@/views/atoms/notificationItems/NotificationStoreNameLink.vue';
import DateBrowseItem from '@/views/molecules/browseItems/DateBrowseItem.vue';

interface Props {
  readonly displayName: string;
  readonly handleName: string;
  readonly storeName: string;
  readonly slug: string;
  readonly notifiedAt: string;
  readonly close: () => void;
}
defineProps<Props>();

function navigateAndClose(close: () => void): void {
  close();
}
</script>
<template>
  <p>
    <NotificationUserNameLink :display-name :handle-name @click="navigateAndClose(close)" />さんが
    <NotificationStoreNameLink :store-name :slug @click="navigateAndClose(close)" />
    の投稿にいいねしました
    <DateBrowseItem class="text-mini" :date="notifiedAt" />
  </p>
</template>
