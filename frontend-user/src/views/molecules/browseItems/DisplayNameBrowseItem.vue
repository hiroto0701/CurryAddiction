<script setup lang="ts">
interface Props {
  readonly displayName: null | string
}

defineProps<Props>()
</script>
<template>
  <p>{{ displayName }}</p>
</template>
