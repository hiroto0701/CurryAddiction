<script setup lang="ts">
import AuthenticatedHeader from '@/views/organisms/AuthenticatedHeader.vue';
import AuthenticatedFooter from '@/views/organisms/AuthenticatedFooter.vue';
</script>
<template>
  <div class="flex h-screen flex-col">
    <AuthenticatedHeader />
    <main
      class="xs:px-7 mx-auto my-16 flex h-auto w-full max-w-4xl flex-col px-6 sm:px-10 md:my-20"
    >
      <RouterView />
    </main>
    <AuthenticatedFooter />
  </div>
</template>
