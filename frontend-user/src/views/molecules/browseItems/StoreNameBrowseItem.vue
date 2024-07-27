<script setup lang="ts">
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'

interface Props {
  readonly storeName: string
}

defineProps<Props>()
</script>
<template>
  <div class="flex h-fit items-center gap-2.5">
    <StoreIcon />
    <h2 class="select-none truncate font-body leading-relaxed">
      {{ storeName }}
    </h2>
  </div>
</template>
