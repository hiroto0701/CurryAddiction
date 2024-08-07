<script setup lang="ts">
import { RouterLink } from 'vue-router';
import PostAvatarBrowseItem from '@/views/molecules/browseItems/PostAvatarBrowseItem.vue';
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue';

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
    class="flex min-w-0 items-center gap-2.5 truncate text-base hover:text-sumi-900"
  >
    <PostAvatarBrowseItem :avatar-url />
    <DisplayNameBrowseItem :display-name />
  </router-link>
</template>
