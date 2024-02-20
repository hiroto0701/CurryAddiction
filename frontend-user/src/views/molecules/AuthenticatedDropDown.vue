<script setup lang="ts">
import { MenuItem } from '@headlessui/vue'
import { RouterLink } from 'vue-router'
import LogoutIcon from '@/views/atoms/icons/LogoutIcon.vue'
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue'
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue';
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue';
import ArchiveIconVue from '@/views/atoms/icons/ArchiveIcon.vue';
import TrashIconVue from '@/views/atoms/icons/TrashIcon.vue';
import MainDropDown from '@/views/atoms/MainDropDown.vue';

const username = 'hiroto';
</script>

<template>
  <MainDropDown :username="username">
    <MenuItem class="flex items-center gap-x-2 text-sm">
      <router-link :to="{ name: 'PostDashboard' }" class="block px-4 py-2 text-sm text-utility hover:bg-slate-100 hover:text-main">
        <DashboardIcon />ダッシュボード
      </router-link>
    </MenuItem>

    <MenuItem class="flex items-center gap-x-2 text-sm">
      <router-link :to="{ name: 'LikedPostDashboard' }" class="block px-4 py-2 text-sm text-utility hover:bg-slate-100 hover:text-main">
        <HeartIcon />いいねした投稿
      </router-link>
    </MenuItem>

    <MenuItem class="flex items-center gap-x-2 text-sm">
      <router-link :to="{ name: 'ArchivedPostDashboard' }" class="block px-4 py-2 text-sm text-utility hover:bg-slate-100 hover:text-main">
        <ArchiveIconVue />保存した投稿
      </router-link>
    </MenuItem>

    <MenuItem class="flex items-center gap-x-2 text-sm">
      <router-link :to="{ name: 'TrashDashboard' }" class="block px-4 py-2 text-sm text-utility hover:bg-slate-100 hover:text-main">
        <TrashIconVue />ごみ箱
      </router-link>
    </MenuItem>

    <MenuItem class="flex items-center gap-x-2 text-sm">
      <router-link :to="{ name: 'Settings' }" class="block px-4 py-2 text-sm text-utility hover:bg-slate-100 hover:text-main">
        <SettingIcon />設定
      </router-link>
    </MenuItem>
    
    <MenuItem class="flex items-center gap-x-2 text-sm">
      <router-link to="#" class="block px-4 py-2 text-sm text-utility hover:bg-slate-100 hover:text-main">
        <LogoutIcon />ログアウト
      </router-link>
    </MenuItem>
  </MainDropDown>
</template>
