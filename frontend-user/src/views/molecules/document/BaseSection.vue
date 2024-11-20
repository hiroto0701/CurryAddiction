<script setup lang="ts">
import BaseHeading from '@/views/atoms/document/BaseHeading.vue';

interface Props {
  title: string;
}

defineProps<Props>();
</script>

<template>
  <section>
    <BaseHeading :level="2">{{ title }}</BaseHeading>
    <slot />
  </section>
</template>
