<script setup lang="ts">
import NotificationUserNameLink from '@/views/atoms/notificationItems/NotificationUserNameLink.vue';
import NotificationStoreNameLink from '@/views/atoms/notificationItems/NotificationStoreNameLink.vue';

interface Props {
  readonly displayName: string;
  readonly handleName: string;
  readonly storeName: string;
  readonly slug: string;
}
defineProps<Props>();
</script>
<template>
  <p>
    <NotificationUserNameLink :display-name :handle-name />さんが
    <NotificationStoreNameLink :store-name :slug /> の投稿にいいねしました
  </p>
</template>
