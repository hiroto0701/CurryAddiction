<script setup lang="ts">
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue'
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue'
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import UserAnalytics from '@/views/molecules/UserAnalytics.vue'
</script>
<template>
  <DashboardContent title="投稿ダッシュボード">
    <DashboardSection>
      <UserAnalytics sign-up-date="2024年11月" :post-summary="5" />
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
