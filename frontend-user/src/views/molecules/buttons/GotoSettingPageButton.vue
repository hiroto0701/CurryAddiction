<script setup lang="ts">
import { RouterLink } from 'vue-router';
import BaseButton from '@/views/atoms/BaseButton.vue';

interface Props {
  text: string;
}
defineProps<Props>();
</script>
<template>
  <RouterLink :to="{ name: 'Setting' }">
    <BaseButton
      class="inline-flex w-full items-center justify-center rounded-full border px-3.5 py-2.5 text-sm text-sumi-900 hover:border-slate-300 hover:bg-slate-100"
      :text
    />
  </RouterLink>
</template>
