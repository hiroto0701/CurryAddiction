<script setup lang="ts">
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

defineProps<Props>()

const emits = defineEmits<{
  (e: 'toPostDashboard' | 'toLikedPostDashboard' | 'toArchivedPostDashboard' | 'toTrashDashboard' | 'toSetting' | 'logout'): void
}>()


const handleMenuItem = (event: 'toPostDashboard' | 'toLikedPostDashboard' | 'toArchivedPostDashboard' | 'toTrashDashboard' | 'toSetting' | 'logout') => {
  emits(event)
}
</script>

<template>
  <HeaderDropDown :username>
    <DropDownMenuItem @click="handleMenuItem('toPostDashboard')" label="ダッシュボード" :iconComponent="DashboardIcon" />
    <DropDownMenuItem @click="handleMenuItem('toLikedPostDashboard')" label="いいねした投稿" :iconComponent="HeartIcon" />
    <DropDownMenuItem @click="handleMenuItem('toArchivedPostDashboard')" label="保存した投稿" :iconComponent="ArchiveIcon" />
    <DropDownMenuItem @click="handleMenuItem('toTrashDashboard')" label="ごみ箱" :iconComponent="TrashIcon" />
    <DropDownMenuItem @click="handleMenuItem('toSetting')" label="設定" :iconComponent="SettingIcon" />
    <DropDownMenuItem @click="handleMenuItem('logout')" label="ログアウト" :iconComponent="LogoutIcon" />
  </HeaderDropDown>
</template>