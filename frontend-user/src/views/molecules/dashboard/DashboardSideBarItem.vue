<script setup lang="ts">
import type { Component } from 'vue'
import type { RouteLocationRaw } from 'vue-router'

interface Props {
  readonly to: RouteLocationRaw
  readonly label: string
  readonly iconComponent: Component
  readonly isActive: boolean
  readonly textColorClass: string
}

defineProps<Props>()
</script>
<template>
  <router-link
    :to="to"
    class="flex px-3 h-11 gap-2.5 rounded-lg items-center hover:bg-slate-100"
    :class="{ 'bg-slate-100': isActive, [textColorClass]: true }"
  >
    <component :is="iconComponent" :class="textColorClass" />
    {{ label }}
  </router-link>
</template>
