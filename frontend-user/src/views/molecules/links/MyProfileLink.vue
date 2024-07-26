<script setup lang="ts">
import { RouterLink } from 'vue-router'
import { useAccountStore } from '@/stores/account'
import AvatarBrowseItem from '@/views/molecules/browseItems/AvatarBrowseItem.vue'

const accountStore = useAccountStore()
</script>
<template>
  <router-link
    :to="{ name: 'UserPage', params: { username: accountStore.state.handle_name } }"
    class="flex w-fit gap-1 font-body text-sumi-600"
  >
    <AvatarBrowseItem class="w-7" :avatar-url="accountStore.state.avatar_url" />
    @{{ accountStore.state.handle_name }}
  </router-link>
</template>
