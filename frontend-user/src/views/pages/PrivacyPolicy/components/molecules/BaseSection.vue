<script setup lang="ts">
import BaseHeading from '@/views/pages/PrivacyPolicy/components/atoms/BaseHeading.vue';

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
