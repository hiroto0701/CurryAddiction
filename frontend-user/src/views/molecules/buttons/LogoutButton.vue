<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue';
import LoadingSpinner from '@/views/atoms/LoadingSpinner.vue';

interface Props {
  readonly text: string;
}
defineProps<Props>();
</script>
<template>
  <BaseButton
    type="button"
    class="flex items-center border border-gray-300 p-3 text-sumi-900 md:hover:border-slate-300 md:hover:bg-slate-100"
    :text
  />
</template>
