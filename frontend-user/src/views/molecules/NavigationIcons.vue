<script setup lang="ts">
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue'
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue'
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue'
import NotificationIcon from '@/views/atoms/icons/NotificationIcon.vue'
import ProfileIcon from '@/views/atoms/icons/ProfileIcon.vue'
import { RouterLink } from 'vue-router'
</script>
<template>
  <div class="flex items-center gap-0.5">
    <router-link :to="{ name: 'Home' }" class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <HomeIcon />
    </router-link>
    <router-link :to="{ name: 'PostRegister' }" class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <PlusIcon />
    </router-link>
    <router-link :to="{ name: 'Search' }" class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <SearchIcon />
    </router-link>
    <div class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <NotificationIcon />
    </div>
    <router-link :to="{ name: 'UserPage' }" class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <ProfileIcon />
    </router-link>
  </div>
</template>