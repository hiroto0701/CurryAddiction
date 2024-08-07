<script setup lang="ts">
interface Props {
  readonly text?: string;
}
defineProps<Props>();
</script>
<template>
  <p>{{ text }}</p>
</template>
