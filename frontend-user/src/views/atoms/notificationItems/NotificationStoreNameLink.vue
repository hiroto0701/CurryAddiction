<script setup lang="ts">
import { RouterLink } from 'vue-router';

interface Props {
  readonly storeName: string;
  readonly slug: string;
}
defineProps<Props>();
</script>
<template>
  <span class="mx-1 font-semibold text-sumi-900 hover:underline">
    <router-link :to="{ name: 'PostViewer', params: { slug } }" class="">
      {{ storeName }}
    </router-link>
  </span>
</template>
