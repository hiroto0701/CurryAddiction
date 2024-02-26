<script setup lang="ts">
import DropDownMenuItem from '@/views/atoms/DropDownMenuItem.vue'
import LogoutIcon from '@/views/atoms/icons/LogoutIcon.vue'
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue'
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue'
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIconVue from '@/views/atoms/icons/ArchiveIcon.vue'
import TrashIconVue from '@/views/atoms/icons/TrashIcon.vue'
import MainDropDown from '@/views/atoms/MainDropDown.vue'

const username = 'hiroto';
</script>

<template>
   <MainDropDown :username="username">
    <DropDownMenuItem :to="{ name: 'PostDashboard' }" label="ダッシュボード" :iconComponent="DashboardIcon" />
    <DropDownMenuItem :to="{ name: 'LikedPostDashboard' }" label="いいねした投稿" :iconComponent="HeartIcon" />
    <DropDownMenuItem :to="{ name: 'ArchivedPostDashboard' }" label="保存した投稿" :iconComponent="ArchiveIconVue" />
    <DropDownMenuItem :to="{ name: 'TrashDashboard' }" label="ごみ箱" :iconComponent="TrashIconVue" />
    <DropDownMenuItem :to="{ name: 'Settings' }" label="設定" :iconComponent="SettingIcon" />
    <DropDownMenuItem :to="{ name: 'Home' }" label="ログアウト" :iconComponent="LogoutIcon" />
  </MainDropDown>
</template>
