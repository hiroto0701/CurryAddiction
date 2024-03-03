<script setup lang="ts">
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue'
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue'
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue'
import NotificationIcon from '@/views/atoms/icons/NotificationIcon.vue'
import ProfileIcon from '@/views/atoms/icons/ProfileIcon.vue'
import { RouterLink } from 'vue-router';
</script>
<template>
  <div class="flex items-center gap-x-3.5">
    <router-link :to="{ name: 'Home' }">
      <HomeIcon />
    </router-link>
    <router-link :to="{ name: 'PostRegister' }">
      <PlusIcon />
    </router-link>
    <router-link :to="{ name: 'Search' }">
      <SearchIcon />
    </router-link>
    <NotificationIcon />
    <router-link :to="{ name: 'UserPage' }">
      <ProfileIcon />
    </router-link>
  </div>
</template>