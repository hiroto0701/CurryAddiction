<script setup lang="ts">
interface Props {
  postSummary: number
}

defineProps<Props>()
</script>
<template>
  <p class="flex items-center font-body text-sumi-900 text-sm">{{ postSummary }}</p>
</template>
