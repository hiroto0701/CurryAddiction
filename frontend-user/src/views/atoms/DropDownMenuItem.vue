<script setup lang="ts">
import { MenuItem } from '@headlessui/vue'
import type { Component } from 'vue'

interface Props {
  readonly label: string
  readonly iconComponent: Component
  readonly isActive?: boolean
  readonly textColorClass: string
  readonly iconProps?: Record<string, string | null>
}

defineProps<Props>()

function navigateAndClose(close: () => void): void {
  close()
}
</script>
<template>
  <MenuItem class="flex items-center gap-x-2 px-4 text-sm" v-slot="{ close }">
    <button
      class="text-md block w-full py-2 font-body text-sumi-500 hover:bg-slate-100 hover:text-sumi-900"
      :class="{ 'bg-slate-100': isActive, [textColorClass]: true }"
      @click="navigateAndClose(close)"
    >
      <div class="w-5">
        <component :is="iconComponent" v-bind="iconProps || {}" />
      </div>
      {{ label }}
    </button>
  </MenuItem>
</template>
