<script setup lang="ts">
import AuthUserHeader from '@/views/organisms/AuthUserHeader.vue';
import MeatballDropDown from '@/views/molecules/dropdown/MeatballDropDown.vue'
import ScrollToTopButton from '@/views/molecules/buttons/ScrollToTopButton.vue'
</script>

<template>
  <div class="h-auto">
    <AuthUserHeader />
    <main class="mx-auto my-12 w-full px-6 xs:px-7 sm:px-10 max-w-4xl flex h-auto flex-col">
      <RouterView />
      <MeatballDropDown />
      <ScrollToTopButton />
    </main>
  </div>
</template>