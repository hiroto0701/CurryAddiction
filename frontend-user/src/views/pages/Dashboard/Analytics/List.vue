<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useFetchAnalytics } from '@/composables/functions/useFetchAnalytics'
import type { Analytics } from '@/composables/types/analytics'
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue'
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue'
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import UserAnalytics from '@/views/molecules/UserAnalytics.vue'
import Heatmap from '@/views/pages/Dashboard/Analytics/components/Heatmap.vue'

const accountStore = useAccountStore()
const { fetchAnalytics } = useFetchAnalytics()

const analyticsData = ref<Analytics[]>([])
async function load() {
  try {
    const { data } = await fetchAnalytics()
    analyticsData.value = data
  } catch (error) {
    console.error('ユーザー情報の読み込みに失敗しました。:', error)
  }
}

await load()
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
      <Heatmap :analytics-data class="mt-5" />
    </DashboardSection>
  </DashboardContent>
</template>
