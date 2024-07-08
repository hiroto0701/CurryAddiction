<script setup lang="ts">
interface Props {
  readonly comment: string
}

defineProps<Props>()
</script>
<template>
  <p class="font-body text-sumi-900 leading-relaxed">{{ comment }}</p>
</template>
