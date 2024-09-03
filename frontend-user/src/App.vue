<script setup lang="ts">
import { onMounted } from 'vue';
import { useCommonStore } from '@/stores/common';
import { useCurryGenreStore } from '@/stores/curry_genre';
import SuccessToast from '@/views/molecules/toasts/SuccessToast.vue';
import ErrorToast from '@/views/molecules/toasts/ErrorToast.vue';

const commonStore = useCommonStore();
const curryGenreStore = useCurryGenreStore();

// カレーのジャンル情報を取得
onMounted(() => {
  curryGenreStore.fetchGenres();
});
</script>
<template>
  <RouterView />
  <SuccessToast v-if="commonStore.state.flashMessage" :message="commonStore.state.flashMessage" />
  <ErrorToast v-if="commonStore.state.errorMessage" :message="commonStore.state.errorMessage" />
</template>
