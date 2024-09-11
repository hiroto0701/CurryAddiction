<script setup lang="ts">
import { RouterLink } from 'vue-router';
import BaseButton from '@/views/atoms/BaseButton.vue';
</script>
<template>
  <div
    class="xs:px-7 mx-auto flex w-full max-w-screen-md flex-col items-center justify-center gap-4 px-6 py-20 sm:px-10"
  >
    <h1 class="font-body text-6xl font-extrabold sm:text-9xl">404</h1>
    <h2 class="font-body font-semibold sm:text-2xl">ページが見つかりません</h2>
    <p class="font-body">お探しのページは存在しないか、移動した可能性があります。</p>
    <router-link :to="{ name: 'Home' }">
      <BaseButton
        class="flex items-center gap-2 border border-sumi-200 bg-sumi-50 p-3 text-sm text-sumi-800"
        text="ホームに戻る"
      />
    </router-link>
  </div>
</template>
