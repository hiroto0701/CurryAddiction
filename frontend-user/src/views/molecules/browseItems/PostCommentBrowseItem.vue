<script setup lang="ts">
interface Props {
  readonly comment?: string;
}

defineProps<Props>();
</script>
<template>
  <p class="font-body leading-relaxed text-sumi-900">{{ comment }}</p>
</template>
