<script setup lang="ts">
import { useCommonStore } from '@/stores/common'

const commonStore = useCommonStore()
</script>

<template>
  <RouterView />
</template>
