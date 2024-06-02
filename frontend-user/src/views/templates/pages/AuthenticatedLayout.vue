<script setup lang="ts">
import { onMounted } from 'vue'
import { useAccountStore } from '@/stores/account'

const accountStore = useAccountStore()

onMounted((): void => {
  accountStore.fetchUserData()
})
</script>
<template>
  <RouterView />
</template>
