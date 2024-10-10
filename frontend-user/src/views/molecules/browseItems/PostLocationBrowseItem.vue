<script setup lang="ts">
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue';

interface Props {
  readonly latitude: number;
  readonly longitude: number;
}
defineProps<Props>();
</script>
<template>
  <div class="mb-3 flex items-center gap-2">
    <LocationIcon />
    <h3 class="font-body font-medium leading-relaxed text-sumi-700">位置情報</h3>
  </div>
  <p>{{ latitude }}</p>
  <p>{{ longitude }}</p>
</template>
