<script setup lang="ts">
import { RouterLink } from 'vue-router';
import { useStorageUrl } from '@/composables/useStorageUrl';

const { getStorageUrl } = useStorageUrl();
</script>

<template>
  <router-link :to="{ name: 'Home' }">
    <img class="h-8 w-auto" :src="getStorageUrl('/logo/app-logo.svg')" alt="App Logo" />
  </router-link>
</template>
