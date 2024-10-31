<script setup lang="ts">
interface Props {
  readonly src: string;
}
defineProps<Props>();
</script>

<template>
  <img :src alt="" class="aspect-square w-5" />
</template>
