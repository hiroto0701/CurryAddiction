<script setup lang="ts">
import { RouterLink } from 'vue-router'
</script>
<template>
  <router-link :to="{ name: 'Home' }">
    <img class="h-8 w-auto" src="../../../assets/logo.svg" alt="App Logo" />
  </router-link>
</template>
