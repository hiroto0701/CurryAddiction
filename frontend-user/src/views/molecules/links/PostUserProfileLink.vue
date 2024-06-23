<script setup lang="ts">
import { RouterLink } from 'vue-router'
import PostAvatarBrowseItem from '@/views/molecules/browseItems/PostAvatarBrowseItem.vue'
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue'

interface Props {
  readonly displayName?: string
  readonly avatarUrl: string | null
}
defineProps<Props>()
</script>
<template>
  <router-link
    :to="{ name: 'UserPage' }"
    class="flex min-w-0 items-center gap-2.5 text-base truncate hover:text-sumi-900"
  >
    <PostAvatarBrowseItem :avatar-url />
    <DisplayNameBrowseItem :display-name />
  </router-link>
</template>
