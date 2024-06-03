<script setup lang="ts">
import { onMounted } from 'vue'
import { useAccountStore } from '@/stores/account'
import MeatballDropDown from '@/views/molecules/dropdown/MeatballDropDown.vue'
import ScrollToTopButton from '@/views/molecules/buttons/ScrollToTopButton.vue'

const accountStore = useAccountStore()

onMounted((): void => {
  accountStore.fetchUserData()
})
</script>
<template>
  <RouterView />
  <MeatballDropDown class="z-50" />
  <ScrollToTopButton class="z-50" />
</template>
