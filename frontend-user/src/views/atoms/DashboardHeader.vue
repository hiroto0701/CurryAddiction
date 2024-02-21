<script setup lang="ts">
interface Props {
  readonly title: string
}
defineProps<Props>();
</script>
<template>
  <header class="flex items-center gap-3 text-xl text-main">
    <h1>{{ title }}</h1>
  </header>
</template>