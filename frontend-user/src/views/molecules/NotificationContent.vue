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
}
defineProps<Props>();
</script>
<template>
  <p>
    <NotificationUserNameLink :display-name :handle-name />さんが
    <NotificationStoreNameLink :store-name :slug /> の投稿にいいねしました
    <DateBrowseItem class="text-mini" :date="notifiedAt" />
  </p>
</template>
