<script setup lang="ts">
interface Props {
  readonly title: string
}
defineProps<Props>()
</script>
<template>
  <header class="flex items-center gap-3 font-body text-xl text-sumi-900">
    <h1>{{ title }}</h1>
  </header>
</template>
