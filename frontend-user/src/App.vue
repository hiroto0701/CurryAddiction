<script setup lang="ts">
import { useCommonStore } from '@/stores/common';
import SuccessToast from '@/views/molecules/toasts/SuccessToast.vue';
import ErrorToast from '@/views/molecules/toasts/ErrorToast.vue';
import { onMounted } from 'vue';

const commonStore = useCommonStore();

// カレーのジャンル情報を取得
onMounted(() => {
  console.log('mounted!!');
});
</script>
<template>
  <RouterView />
  <SuccessToast v-if="commonStore.state.flashMessage" :message="commonStore.state.flashMessage" />
  <ErrorToast v-if="commonStore.state.errorMessage" :message="commonStore.state.errorMessage" />
</template>
