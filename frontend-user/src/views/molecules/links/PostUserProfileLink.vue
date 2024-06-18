<script setup lang="ts">
import { RouterLink } from 'vue-router'
import { useAccountStore } from '@/stores/account'
import ProfileImgBrowseItem from '@/views/molecules/browseItems/AvatarBrowseItem.vue'

const accountStore = useAccountStore()
</script>
<template>
  <router-link
    :to="{ name: 'UserPage' }"
    class="flex min-w-0 items-center gap-2.5 text-base truncate hover:text-sumi-900"
  >
    <ProfileImgBrowseItem class="w-7" />
    {{ accountStore.state.handle_name }}
  </router-link>
</template>
