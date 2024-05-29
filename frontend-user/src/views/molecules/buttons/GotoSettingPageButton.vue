<script setup lang="ts">
import { RouterLink } from 'vue-router'
import BaseButton from '@/views/atoms/BaseButton.vue'

interface Props {
  text: string
}
defineProps<Props>()
</script>
<template>
  <RouterLink :to="{ name: 'Setting' }">
    <BaseButton class="inline-flex items-center justify-center text-sumi-900 border rounded-full text-sm py-2.5 px-3.5" :text />
  </RouterLink>
</template>
