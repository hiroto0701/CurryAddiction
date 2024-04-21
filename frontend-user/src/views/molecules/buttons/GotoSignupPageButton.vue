<script setup lang="ts">
import { RouterLink } from 'vue-router'
import BaseButton from '@/views/atoms/BaseButton.vue'

interface Props {
  text: string
}
defineProps<Props>();
</script>
<template>
  <RouterLink :to="{ name: 'Signup' }">
    <BaseButton class="mt-5 py-3 px-10 bg-transparent text-sky-500 border border-sky-500 font-semibold" :text />
  </RouterLink>
</template>
