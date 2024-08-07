<script setup lang="ts">
interface Props {
  readonly content?: string;
}
defineProps<Props>();
</script>
<template>
  <p class="mx-auto w-fit whitespace-pre-wrap font-body text-sm leading-6 text-sumi-500">
    {{ content }}
  </p>
</template>
