<script setup lang="ts">
import { MenuItem } from '@headlessui/vue'
import { type Component } from 'vue';
import { type RouteLocationRaw } from 'vue-router';

interface Props {
  readonly to: RouteLocationRaw;
  readonly label: string;
  readonly iconComponent: Component;
}
defineProps<Props>();
</script>
<template>
  <MenuItem class="flex items-center gap-x-2 text-sm">
    <router-link 
      :to 
      class="block px-4 py-2 text-sm text-sumi-500 hover:bg-slate-100 hover:text-sumi-900 font-body"
    >
      <component :is="iconComponent" />
      {{ label }}
    </router-link>
  </MenuItem>
</template>