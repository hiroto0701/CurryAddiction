<script setup lang="ts">
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'

interface Props {
  readonly storeName: string
}

defineProps<Props>()
</script>
<template>
  <div class="h-fit flex items-center gap-2.5">
    <StoreIcon />
    <h1 class="font-body select-none leading-relaxed truncate">
      {{ storeName }}
    </h1>
  </div>
</template>
