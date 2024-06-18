<script setup lang="ts">
import { RouterLink } from 'vue-router'
import { useAccountStore } from '@/stores/account'
import ProfileImgBrowseItem from '@/views/molecules/browseItems/AvatarBrowseItem.vue'

const accountStore = useAccountStore()
</script>
<template>
  <router-link :to="{ name: 'UserPage' }" class="flex gap-1 font-body text-sumi-600 w-fit">
    <ProfileImgBrowseItem class="w-7" />
    @{{ accountStore.state.handle_name }}
  </router-link>
</template>
