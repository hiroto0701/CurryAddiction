<script setup lang="ts">
import { MenuItem } from '@headlessui/vue'
import { RouterLink } from 'vue-router'
import LogoutIcon from '@/views/atoms/icons/LogoutIcon.vue'
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue'
import MainDropDown from '@/views/atoms/MainDropDown.vue';

const username = 'hiroto';
</script>

<template>
  <MainDropDown :username="username">
    <MenuItem class="flex items-center gap-x-2 text-sm" v-slot="{ active }">
      <router-link :to="{ name: 'Settings' }" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
        <SettingIcon />設定
      </router-link>
    </MenuItem>
    
    <MenuItem class="flex items-center gap-x-2 text-sm" v-slot="{ active }">
      <router-link to="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
        <LogoutIcon />ログアウト
      </router-link>
    </MenuItem>
  </MainDropDown>
</template>
