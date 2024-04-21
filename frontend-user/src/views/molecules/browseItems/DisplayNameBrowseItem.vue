<script setup lang="ts">
interface Props {
  readonly value: string
}

defineProps<Props>();
</script>
<template>
  <p>{{ value }}</p>
</template>
