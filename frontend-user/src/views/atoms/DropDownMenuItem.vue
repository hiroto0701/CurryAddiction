<script setup lang="ts">
import { MenuItem } from '@headlessui/vue'
import { type Component } from 'vue'
import { type RouteLocationRaw, useRouter } from 'vue-router'

interface Props {
  readonly to: RouteLocationRaw
  readonly label: string
  readonly iconComponent: Component
}
defineProps<Props>()

const router = useRouter()

function navigateAndClose(route: RouteLocationRaw, close: () => void): void {
  router.push(route).then((): void => {
    close()
  })
}

</script>
<template>
  <MenuItem class="flex items-center gap-x-2 text-sm" v-slot="{ close }">
    <a href="" 
      class="block px-4 py-2 text-md text-sumi-500 hover:bg-slate-100 hover:text-sumi-900 font-body"
      @click.prevent="navigateAndClose(to, close)"
    >
      <component :is="iconComponent" />
      {{ label }}
    </a>
  </MenuItem>
</template>
