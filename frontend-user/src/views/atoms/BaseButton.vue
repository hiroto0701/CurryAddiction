<script setup lang="ts">
interface Props {
  readonly text: string;
}

defineProps<Props>();
</script>
<template>
  <button type="button" class="rounded-full text-body hover:opacity-70 duration-500">
    {{ text }}
  </button>
</template>