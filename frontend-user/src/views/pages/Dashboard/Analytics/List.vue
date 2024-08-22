<script setup lang="ts">
import { useAccountStore } from '@/stores/account';
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue';
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue';
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue';
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue';
import UserAnalytics from '@/views/molecules/UserAnalytics.vue';
import Analytics from '@/views/pages/Dashboard/Analytics/components/Analytics.vue';

const accountStore = useAccountStore();
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
        class="mt-3 font-body text-sm text-sumi-500"
      />
      <Suspense>
        <template #default>
          <Analytics class="mt-5" />
        </template>

        <template #fallback>
          <div class="mt-5 flex justify-center" aria-label="読み込み中">
            <div
              class="aspect-square w-6 animate-spin rounded-full border-2 border-gray-400"
              style="border-top-color: transparent"
            ></div>
          </div>
        </template>
      </Suspense>
    </DashboardSection>
  </DashboardContent>
</template>
