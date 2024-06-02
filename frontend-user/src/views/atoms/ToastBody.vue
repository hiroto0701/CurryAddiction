<script setup lang="ts">
import { type Component } from 'vue'

interface Props {
  readonly message: null | string
  readonly iconComponent: null | Component
}
defineProps<Props>()
</script>
<template>
  <component :is="iconComponent" />
  <p class="font-body text-sm text-white">{{ message }}</p>
</template>
