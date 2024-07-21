<script setup lang="ts">
interface Props {
  readonly text: string
}
defineProps<Props>()
</script>
<template>
  <p class="font-body text-sumi-900 text-sm mt-6 leading-6">{{ text }}</p>
</template>
