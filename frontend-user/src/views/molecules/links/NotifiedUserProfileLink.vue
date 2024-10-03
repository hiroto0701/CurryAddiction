<script setup lang="ts">
import { RouterLink } from 'vue-router';
import NotificationAvatarBrowseItem from '@/views/molecules/browseItems/NotificationAvatarBrowseItem.vue';

interface Props {
  readonly displayName?: string;
  readonly handleName: string;
  readonly avatarUrl: string | null;
}
defineProps<Props>();
</script>
<template>
  <router-link
    :to="{ name: 'UserPage', params: { username: handleName } }"
    class="min-w-0 truncate text-base hover:text-sumi-900"
  >
    <NotificationAvatarBrowseItem :avatar-url />
  </router-link>
</template>
