<script setup lang="ts">
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue'
import Date from '@/views/atoms/Date.vue'

interface Props {
  readonly location: string
  readonly date: string
}

defineProps<Props>()
</script>
<template>
  <div class="px-3 py-1 flex items-center gap-2.5 relative">
    <LocationIcon />
    <span
      class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700"
    >
      {{ location }}
    </span>
    <Date :date="date" />
  </div>
</template>
