<script setup lang="ts">
interface Props {
  readonly displayName: null | string
}

defineProps<Props>()
</script>
<template>
  <p class="text-sumi-900">{{ displayName }}</p>
</template>
