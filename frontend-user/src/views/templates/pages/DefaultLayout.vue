<script setup lang="ts">
import AuthenticatedHeader from '@/views/organisms/AuthenticatedHeader.vue'
import MeatballDropDown from '@/views/molecules/dropdown/MeatballDropDown.vue'
import ScrollToTopButton from '@/views/molecules/buttons/ScrollToTopButton.vue'
import AuthenticatedFooter from '@/views/organisms/AuthenticatedFooter.vue'
</script>
<template>
  <div class="flex flex-col h-screen">
    <AuthenticatedHeader />
    <main class="mx-auto my-12 w-full px-6 xs:px-7 sm:px-10 max-w-4xl flex h-auto flex-col">
      <RouterView />
      <MeatballDropDown class="z-50" />
      <ScrollToTopButton class="z-50" />
    </main>
    <AuthenticatedFooter />
  </div>
</template>
