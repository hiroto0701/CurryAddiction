<script setup lang="ts">
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'

interface Props {
  readonly storeName: string
}

defineProps<Props>();
</script>
<template>
  <div class="px-3 py-1 h-fit flex items-center gap-2.5">
    <StoreIcon />
    <p class="font-normal font-body text-md">{{ storeName }}</p>
  </div>
</template>