<script setup lang="ts">
interface Props {
  readonly title: string
}

defineProps<Props>()
</script>
<template>
  <p class="font-body w-fit mx-auto text-sumi-900 text-lg">{{ title }}</p>
</template>
