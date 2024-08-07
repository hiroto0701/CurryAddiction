<script setup lang="ts">
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue';

interface Props {
  readonly location: string;
  readonly date: string;
}
defineProps<Props>();
</script>
<template>
  <div class="relative flex items-center gap-2.5 px-3 py-1">
    <LocationIcon />
    <span
      class="inline-block select-none rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700"
    >
      {{ location }}
    </span>
  </div>
</template>
