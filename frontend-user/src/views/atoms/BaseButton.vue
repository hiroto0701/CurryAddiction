<script setup lang="ts">
interface Props {
  readonly text: string;
}

defineProps<Props>();
</script>
<template>
  <button type="button" class="rounded-full text-body">
    {{ text }}
  </button>
</template>