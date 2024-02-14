<script setup lang="ts">
import UserHeader from '@/views/organisms/UserHeader.vue';

</script>

<template>
  <div class="min-h-full">
    <UserHeader />
    <main class="mx-auto mt-12 w-full px-6 xs:px-7 sm:px-10 max-w-4xl flex min-h-screen flex-col">
      <RouterView />
    </main>
  </div>
</template>