<script setup lang="ts">
import { RouterLink } from 'vue-router';

interface Props {
  readonly displayName: string;
  readonly handleName: string;
}
defineProps<Props>();
</script>
<template>
  <span class="mr-1 font-semibold text-sumi-900 hover:underline">
    <router-link :to="{ name: 'UserPage', params: { username: handleName } }" class="">
      {{ displayName }}
    </router-link>
  </span>
</template>
