<script setup lang="ts">
import { useCommonStore } from '@/stores/common'
import SuccessToast from '@/views/molecules/toasts/SuccessToast.vue'
import LoadingBounce from '@/views/atoms/LoadingBounce.vue';

const commonStore = useCommonStore()
</script>
<template>
  <RouterView />
  <SuccessToast 
    v-if="commonStore.state.flashMessage"
    :message="commonStore.state.flashMessage"
  />
  <LoadingBounce v-show="commonStore.state.loginLoading" />
</template>
