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

</template>
