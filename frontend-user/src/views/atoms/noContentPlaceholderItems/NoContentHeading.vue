<script setup lang="ts">
interface Props {
  readonly text: string;
}
defineProps<Props>();
</script>
<template>
  <p class="mt-8 font-body text-lg text-sumi-900">{{ text }}</p>
</template>
