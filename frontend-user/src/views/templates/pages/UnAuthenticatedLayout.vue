<script setup lang="ts">
import UnAuthenticatedHeader from '@/views/organisms/UnAuthenticatedHeader.vue';
</script>
<template>
  <div class="flex h-screen flex-col">
    <UnAuthenticatedHeader />
    <RouterView />
  </div>
</template>
