<script setup lang="ts">
interface Props {
  readonly text: string;
}
defineProps<Props>();
</script>
<template>
  <p class="flex justify-center font-body leading-loose text-sumi-800">
    {{ text }}
  </p>
</template>
