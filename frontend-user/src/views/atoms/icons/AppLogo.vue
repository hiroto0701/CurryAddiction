<script setup lang="ts">
import { RouterLink } from 'vue-router'
</script>
<template>
  <router-link :to="{ name: 'Home' }">
    <img
      class="h-8 w-auto"
      src="http://localhost:9000/local-curry_addiction/logo/app-logo.svg"
      alt="App Logo"
    />
  </router-link>
</template>
