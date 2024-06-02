<script setup lang="ts">
import { useRouter } from 'vue-router'
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue'
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue'
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue'
import BackButtonIcon from '@/views/atoms/icons/BackButtonIcon.vue'
import DashBoardSidebarItem from '@/views/molecules/dashboard/DashboardSideBarItem.vue'

const router = useRouter()

const getTextColorClass = (routeName: string): string => {
  return router.currentRoute.value.name === routeName ? 'text-main' : 'text-utility'
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
        :to="{ name: 'PostDashboard' }"
        label="ダッシュボード"
        :iconComponent="DashboardIcon"
        :isActive="router.currentRoute.value.name === 'PostDashboard'"
        :textColorClass="getTextColorClass('PostDashboard')"
      />
      <DashBoardSidebarItem
        :to="{ name: 'LikedPostDashboard' }"
        label="いいねした投稿"
        :iconComponent="HeartIcon"
        :isActive="router.currentRoute.value.name === 'LikedPostDashboard'"
        :textColorClass="getTextColorClass('LikedPostDashboard')"
      />
      <DashBoardSidebarItem
        :to="{ name: 'ArchivedPostDashboard' }"
        label="保存した投稿"
        :iconComponent="ArchiveIcon"
        :isActive="router.currentRoute.value.name === 'ArchivedPostDashboard'"
        :textColorClass="getTextColorClass('ArchivedPostDashboard')"
      />
      <DashBoardSidebarItem
        :to="{ name: 'TrashDashboard' }"
        label="ごみ箱"
        :iconComponent="TrashIcon"
        :isActive="router.currentRoute.value.name === 'TrashDashboard'"
        :textColorClass="getTextColorClass('TrashDashboard')"
      />
      <DashBoardSidebarItem
        :to="{ name: 'Setting' }"
        label="設定"
        :iconComponent="SettingIcon"
        :isActive="router.currentRoute.value.name === 'Setting'"
        :textColorClass="getTextColorClass('Setting')"
      />
    </div>
  </aside>
</template>
