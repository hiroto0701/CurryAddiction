<script setup lang="ts">
import UnAuthenticatedHeader from '@/views/organisms/UnAuthenticatedHeader.vue'

</script>
<template>
  <div class="h-auto">
    <UnAuthenticatedHeader />
    <main class="mx-auto my-12 w-full px-6 xs:px-7 sm:px-10 max-w-4xl flex h-auto flex-col">
      <RouterView />
    </main>
  </div>
</template>