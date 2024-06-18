<script setup lang="ts">
import type { Component } from 'vue'
import DropDownMenuItem from '@/views/atoms/DropDownMenuItem.vue'
import LogoutIcon from '@/views/atoms/icons/LogoutIcon.vue'
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue'
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue'
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue'
import HeaderDropDown from '@/views/molecules/dropdown/HeaderDropdown.vue'

interface Props {
  readonly username: null | string
}

interface MenuItem {
  label: string
  icon: Component
  event:
    | 'toPostDashboard'
    | 'toLikedPostDashboard'
    | 'toArchivedPostDashboard'
    | 'toTrashDashboard'
    | 'toSetting'
    | 'logout'
}

defineProps<Props>()

const emits = defineEmits<{
  (
    e:
      | 'toPostDashboard'
      | 'toLikedPostDashboard'
      | 'toArchivedPostDashboard'
      | 'toTrashDashboard'
      | 'toSetting'
      | 'logout'
  ): void
}>()

const handleMenuItem = (
  e:
    | 'toPostDashboard'
    | 'toLikedPostDashboard'
    | 'toArchivedPostDashboard'
    | 'toTrashDashboard'
    | 'toSetting'
    | 'logout'
) => {
  emits(e)
}

const menuItems: MenuItem[] = [
  { label: 'ダッシュボード', icon: DashboardIcon, event: 'toPostDashboard' },
  { label: 'いいねした投稿', icon: HeartIcon, event: 'toLikedPostDashboard' },
  { label: '保存した投稿', icon: ArchiveIcon, event: 'toArchivedPostDashboard' },
  { label: 'ごみ箱', icon: TrashIcon, event: 'toTrashDashboard' },
  { label: '設定', icon: SettingIcon, event: 'toSetting' },
  { label: 'ログアウト', icon: LogoutIcon, event: 'logout' }
]
</script>
<template>
  <HeaderDropDown :username>
    <DropDownMenuItem
      v-for="item in menuItems"
      :key="item.event"
      @click="handleMenuItem(item.event)"
      :label="item.label"
      :iconComponent="item.icon"
      textColorClass="text-sumi-500"
    />
  </HeaderDropDown>
</template>
