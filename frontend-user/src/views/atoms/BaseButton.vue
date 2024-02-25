<script setup lang="ts">
interface Props {
  readonly text: string;
}

defineProps<Props>();
</script>
<template>
  <button type="button">
    {{ text }}
  </button>
</template>