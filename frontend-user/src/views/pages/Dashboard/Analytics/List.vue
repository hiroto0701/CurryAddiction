<script setup lang="ts">
import { useAccountStore } from '@/stores/account'
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue'
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue'
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import UserAnalytics from '@/views/molecules/UserAnalytics.vue'

const accountStore = useAccountStore()
</script>
<template>
  <DashboardContent title="投稿ダッシュボード">
    <DashboardSection>
      <UserAnalytics
        :registered-at="accountStore.state.registered_at"
        :post-summary="accountStore.state.post_summary"
      />
    </DashboardSection>

    <DashboardSection>
      <DashboardSectionHeader title="アクティビティ" />
      <SectionInfo
        text="投稿したらカレンダーに色がつきます。"
        class="text-sm font-body text-sumi-500 mt-3"
      />
    </DashboardSection>
  </DashboardContent>
</template>
