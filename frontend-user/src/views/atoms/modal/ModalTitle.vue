<script setup lang="ts">
interface Props {
  readonly title: string;
}

defineProps<Props>();
</script>
<template>
  <p class="mx-auto w-fit font-body text-lg text-sumi-900">{{ title }}</p>
</template>
