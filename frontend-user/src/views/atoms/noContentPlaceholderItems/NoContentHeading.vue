<script setup lang="ts">
interface Props {
  readonly text: string
}
defineProps<Props>()
</script>
<template>
  <p class="font-body text-sumi-900 text-lg mt-8">{{ text }}</p>
</template>
