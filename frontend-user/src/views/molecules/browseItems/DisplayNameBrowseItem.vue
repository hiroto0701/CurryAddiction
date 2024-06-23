<script setup lang="ts">
interface Props {
  readonly displayName?: string
}

defineProps<Props>()
</script>
<template>
  <p class="font-body">{{ displayName }}</p>
</template>
