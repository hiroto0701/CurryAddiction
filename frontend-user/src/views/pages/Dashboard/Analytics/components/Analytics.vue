<script setup lang="ts">
import { ref } from 'vue';
import { useFetchAnalytics } from '@/composables/useFetchAnalytics';
import type { Analytics } from '@/types/analytics';
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
  <Heatmap class="mt-5" :analytics-data />
</template>
