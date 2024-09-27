<script setup lang="ts">
interface Props {
  readonly title: string;
}
defineProps<Props>();
</script>
<template>
  <header class="flex items-center gap-3">
    <h1 class="font-body text-xl text-sumi-900">{{ title }}</h1>
  </header>
</template>
