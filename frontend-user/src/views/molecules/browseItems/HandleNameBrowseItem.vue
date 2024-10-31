<script setup lang="ts">
interface Props {
  readonly handleName: null | string;
}

defineProps<Props>();
</script>

<template>
  <p class="truncate font-body text-sm text-sumi-500">curry-addiction.com/{{ handleName }}</p>
</template>
