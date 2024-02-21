<script setup lang="ts">
import DashboardHeader from '@/views/atoms/DashboardHeader.vue'

interface Props {
  readonly title: string
}
defineProps<Props>();
</script>
<template>
  <DashboardHeader :title="title" />
  <div>
    <div class="mt-12">
      <div class="flex flex-col gap-11">
        <slot />
      </div>
    </div>
  </div>
</template>