<script setup lang="ts">
import { useStorageUrl } from '@/composables/useStorageUrl';

const { getStorageUrl } = useStorageUrl();
</script>

<template>
  <img
    class="aspect-square"
    :src="getStorageUrl('/logo/curry_pot.svg')"
    alt="アプリケーションロゴ画像"
  />
</template>
