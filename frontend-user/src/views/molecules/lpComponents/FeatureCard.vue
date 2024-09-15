<script setup lang="ts">
import type { Component } from 'vue';

interface Props {
  readonly icon: Component;
  readonly title: string;
  readonly text: string;
}
defineProps<Props>();
</script>
<template>
  <div class="border-sumi-150 rounded-xl border p-7">
    <div class="flex items-center justify-center">
      <component :is="icon" class="w-7 text-sumi-800" />
    </div>
    <h3 class="mt-1 flex items-center justify-center font-body text-lg font-medium text-sumi-900">
      {{ title }}
    </h3>
    <p
      class="mt-3 flex items-center justify-center font-body text-xs leading-relaxed text-sumi-900"
    >
      {{ text }}
    </p>
  </div>
</template>
