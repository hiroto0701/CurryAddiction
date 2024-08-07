<script setup lang="ts">
interface Props {
  readonly postSummary: number;
}

defineProps<Props>();
</script>
<template>
  <p class="flex items-center font-body text-sm text-sumi-900">{{ postSummary }}</p>
</template>
