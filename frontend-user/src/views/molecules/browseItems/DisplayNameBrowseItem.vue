<script setup lang="ts">
interface Props {
  readonly displayName?: string;
}

defineProps<Props>();
</script>

<template>
  <p class="truncate font-body">{{ displayName }}</p>
</template>
