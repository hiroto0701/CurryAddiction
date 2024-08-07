<script setup lang="ts">
import { useCommonStore } from '@/stores/common';
import SuccessToast from '@/views/molecules/toasts/SuccessToast.vue';
import ErrorToast from '@/views/molecules/toasts/ErrorToast.vue';

const commonStore = useCommonStore();
</script>
<template>
  <RouterView />
  <SuccessToast v-if="commonStore.state.flashMessage" :message="commonStore.state.flashMessage" />
  <ErrorToast v-if="commonStore.state.errorMessage" :message="commonStore.state.errorMessage" />
</template>
