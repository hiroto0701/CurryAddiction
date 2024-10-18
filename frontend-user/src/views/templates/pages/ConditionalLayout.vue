<script setup lang="ts">
import { useAccountStore } from '@/stores/account';
import AuthenticatedLayout from '@/views/templates/pages/AuthenticatedLayout.vue';
import UnAuthenticatedLayout from '@/views/templates/pages/UnAuthenticatedLayout.vue';

const accountStore = useAccountStore();
</script>
<template>
  <AuthenticatedLayout v-if="accountStore.isAuthenticated" />
  <UnAuthenticatedLayout v-else />
</template>
