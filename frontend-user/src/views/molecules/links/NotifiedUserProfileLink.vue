<script setup lang="ts">
import { RouterLink } from 'vue-router';
import NotificationAvatarBrowseItem from '@/views/molecules/browseItems/NotificationAvatarBrowseItem.vue';

interface Props {
  readonly displayName?: string;
  readonly handleName: string;
  readonly avatarUrl: string | null;
  readonly close: () => void;
}
defineProps<Props>();

function navigateAndClose(close: () => void): void {
  close();
}
</script>

<template>
  <router-link
    :to="{ name: 'UserPage', params: { username: handleName } }"
    class="h-fit min-w-0 truncate text-base hover:text-sumi-900"
    @click="navigateAndClose(close)"
  >
    <NotificationAvatarBrowseItem :avatar-url />
  </router-link>
</template>
