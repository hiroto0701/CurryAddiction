<script setup lang="ts">
import { type Component } from 'vue';

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly optional: boolean;
  readonly iconComponent: Component;
}

defineProps<Props>();
</script>
<template>
  <div class="my-8">
    <label class="flex items-center gap-2">
      <component :is="iconComponent" class="text-sumi-900" />
      <span class="fw-bold">{{ label }}</span>
      <span v-if="required" class="inline-flex items-center rounded bg-red-500 px-1 py-0.5 text-mini font-body font-normal text-white">必須</span>
      <span v-else-if="optional" class="inline-flex items-center rounded bg-green-500 px-1 py-0.5 text-mini font-body font-normal text-white">任意</span>
    </label>
    <slot />
  </div>
</template>
