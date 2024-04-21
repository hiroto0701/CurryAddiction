<script setup lang="ts">
interface Props {
  readonly title: string
}
defineProps<Props>();
</script>
<template>
  <header class="flex items-center gap-3 text-base text-main">
    <div class="flex items-center justify-between">
      <h2>{{ title }}</h2>
    </div>
  </header>
</template>
