<script setup lang="ts">
import { ref } from 'vue';
import { useFetchAnalytics } from '@/composables/functions/useFetchAnalytics';
import type { Analytics } from '@/composables/types/analytics';
import Heatmap from '@/views/pages/Dashboard/Analytics/components/Heatmap.vue';

const { fetchAnalytics } = useFetchAnalytics();

const analyticsData = ref<Analytics[]>([]);
async function load(): Promise<void> {
  try {
    const { data } = await fetchAnalytics();
    analyticsData.value = data;
  } catch (error) {
    console.error('ユーザー情報の読み込みに失敗しました。:', error);
  }
}

await load();
</script>
<template>
  <Heatmap :analytics-data />
</template>
