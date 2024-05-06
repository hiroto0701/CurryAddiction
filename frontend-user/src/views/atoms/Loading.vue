<script setup lang="ts">
import { useCommonStore } from '@/stores/common'

const commonStore = useCommonStore()
</script>
<template>
  <div v-show="commonStore.state.apiLoading" class="flex justify-center">
    <div class="animate-spin h-5 w-5 border-2 border-sky-400 rounded-full" style="border-top-color: transparent"></div>
  </div>
</template>
