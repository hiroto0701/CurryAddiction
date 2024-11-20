<script setup lang="ts">
import { computed } from 'vue';

interface Props {
  level: 1 | 2;
}

const props = defineProps<Props>();

const tag = computed(() => `h${props.level}`);
const className = computed(() => {
  return props.level === 1
    ? 'mx-auto w-fit font-body text-2xl font-medium text-sumi-800'
    : 'w-full border-b border-gray-200 pb-2 font-body text-lg text-sumi-800';
});
</script>

<template>
  <component :is="tag" :class="className">
    <slot />
  </component>
</template>
