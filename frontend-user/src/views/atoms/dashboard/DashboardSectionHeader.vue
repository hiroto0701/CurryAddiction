<script setup lang="ts">
interface Props {
  readonly title: string;
}
defineProps<Props>();
</script>
<template>
  <header class="flex items-center gap-3">
    <div class="flex items-center justify-between">
      <h2 class="font-body text-base text-sumi-900">{{ title }}</h2>
    </div>
  </header>
</template>
