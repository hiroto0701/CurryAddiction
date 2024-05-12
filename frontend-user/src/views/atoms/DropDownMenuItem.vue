<script setup lang="ts">
import { MenuItem } from '@headlessui/vue'
import { type Component } from 'vue'

interface Props {
  readonly label: string
  readonly iconComponent: Component
}

defineProps<Props>()

function navigateAndClose(close: () => void): void {
  close()
}
</script>

<template>
  <MenuItem class="flex items-center gap-x-2 px-4 text-sm" v-slot="{ close }">
    <button
      class="block w-full py-2 text-md text-sumi-500 hover:bg-slate-100 hover:text-sumi-900 font-body"
      @click="navigateAndClose(close)"
    >
      <component :is="iconComponent" class="w-6" />
      {{ label }}
    </button>
  </MenuItem>
</template>