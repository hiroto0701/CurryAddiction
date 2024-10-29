<script setup lang="ts">
import type { Component } from 'vue';

interface Props {
  readonly icon: Component;
  readonly title: string;
}

defineProps<Props>();
</script>

<template>
  <div class="flex items-center gap-2 text-sumi-700">
    <component :is="icon" />
    <h2 class="font-body font-medium">{{ title }}</h2>
  </div>
</template>
