<script setup lang="ts">
import SuccessToast from '@/views/molecules/toasts/SuccessToast.vue'
import { useCommonStore } from '@/stores/common'

const commonStore = useCommonStore()
</script>
<template>
  <RouterView />
  <SuccessToast 
    v-if="commonStore.state.flashMessage"
    :message="commonStore.state.flashMessage"
  />
  <!-- <div v-show="commonStore.state.apiLoading" class="flex justify-center my-20 fixed top-1/2 -translate-y-1/2 left-1/2">
    <div class="animate-ping h-4 w-4 bg-sky-400 rounded-full"></div>
  </div> -->
  <!-- <div v-show="commonStore.state.apiLoading" class="flex justify-center my-20 fixed top-1/2 -translate-y-1/2 left-1/2">
    <div class="animate-spin h-5 w-5 border-2 border-blue-400 rounded-full" style="border-top-color: transparent"></div>
  </div> -->
</template>
