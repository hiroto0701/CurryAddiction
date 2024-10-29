<script setup lang="ts">
interface Props {
  readonly text: string;
}
defineProps<Props>();
</script>

<template>
  <p class="mt-6 whitespace-pre-line font-body text-sm leading-7 text-sumi-900">{{ text }}</p>
</template>
