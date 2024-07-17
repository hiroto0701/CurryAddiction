<script setup lang="ts">
import { useAccountStore } from '@/stores/account'
import MeatballDropDown from '@/views/molecules/dropdown/MeatballDropDown.vue'
import ScrollToTopButton from '@/views/molecules/buttons/ScrollToTopButton.vue'

const accountStore = useAccountStore()
</script>
<template>
  <RouterView />
  <MeatballDropDown
    class="z-10"
    :key="accountStore.state.avatar_url ?? ''"
    :handle-name="accountStore.state.handle_name"
    :avatar-url="accountStore.state.avatar_url"
  />
  <ScrollToTopButton class="z-10" />
</template>
