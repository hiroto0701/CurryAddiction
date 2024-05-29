<script setup lang="ts">
import { RouterLink } from 'vue-router'
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue'
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue'
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue'
import NotificationIcon from '@/views/atoms/icons/NotificationIcon.vue'
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue'

</script>
<template>
  <div class="flex items-center gap-0.5 max-md:hidden">
    <router-link :to="{ name: 'Home' }" class="w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <HomeIcon />
    </router-link>
    <router-link :to="{ name: 'PostCreate' }" class="w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <PlusIcon />
    </router-link>
    <router-link :to="{ name: 'Search' }" class="w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <SearchIcon />
    </router-link>
    <div class="w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <NotificationIcon />
    </div>
    <router-link :to="{ name: 'UserPage' }" class="w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center">
      <AvatarIcon />
    </router-link>
  </div>
</template>
