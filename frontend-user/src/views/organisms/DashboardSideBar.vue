<script setup lang="ts">
import type { Component } from 'vue'
import { useRouter } from 'vue-router'
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue'
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue'
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue'
import BackButtonIcon from '@/views/atoms/icons/BackButtonIcon.vue'
import DashBoardSidebarItem from '@/views/molecules/dashboard/DashboardSideBarItem.vue'

interface SidebarItem {
  readonly name: string
  readonly label: string
  readonly icon: Component
}

const router = useRouter()
const sidebarItems: SidebarItem[] = [
  {
    name: 'PostDashboard',
    label: 'ダッシュボード',
    icon: DashboardIcon
  },
  {
    name: 'LikedPostDashboard',
    label: 'いいねした投稿',
    icon: HeartIcon
  },
  {
    name: 'ArchivedPostDashboard',
    label: '保存した投稿',
    icon: ArchiveIcon
  },
  {
    name: 'TrashDashboard',
    label: 'ごみ箱',
    icon: TrashIcon
  },
  {
    name: 'Setting',
    label: '設定',
    icon: SettingIcon
  }
]

function getTextColorClass(routeName: string): string {
  return router.currentRoute.value.name === routeName ? 'text-sumi-900' : 'text-sumi-500'
}
</script>
<template>
  <aside class="sticky top-0 hidden p-5 md:block" style="width: 258px">
    <DashBoardSidebarItem
      :to="{ name: 'Home' }"
      label="ホームへ"
      :iconComponent="BackButtonIcon"
      :isActive="router.currentRoute.value.name === 'Home'"
      :textColorClass="getTextColorClass('Home')"
    />
    <div class="mt-8 flex flex-col gap-2.5">
      <DashBoardSidebarItem
        v-for="item in sidebarItems"
        :key="item.name"
        :to="{ name: item.name }"
        :label="item.label"
        :iconComponent="item.icon"
        :isActive="router.currentRoute.value.name === item.name"
        :textColorClass="getTextColorClass(item.name)"
      />
    </div>
  </aside>
</template>
