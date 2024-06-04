<script setup lang="ts">
interface Props {
  readonly content?: string
}

defineProps<Props>()
</script>
<template>
  <p class="font-body leading-6 w-fit mx-auto text-sumi-500 text-sm">{{ content }}</p>
</template>
