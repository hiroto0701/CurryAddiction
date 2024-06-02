<script setup lang="ts">
import UnAuthenticatedHeader from '@/views/organisms/UnAuthenticatedHeader.vue'
</script>
<template>
  <div class="flex flex-col h-screen">
    <UnAuthenticatedHeader />
    <RouterView />
  </div>
</template>
