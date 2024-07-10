<script setup lang="ts">
import TrashCardPreview from '@/views/pages/Dashboard/Trash/components/TrashCardPreview.vue'
import TrashCardDetails from '@/views/pages/Dashboard/Trash/components/TrashCardDetails.vue'

interface Props {
  readonly storeName: string
  readonly src: string
  readonly deletedAt: string
  readonly comment?: string
}
defineProps<Props>()
</script>
<template>
  <div class="flex gap-5 sm:gap-7">
    <TrashCardPreview :store-name :src :comment />
    <TrashCardDetails :store-name :deleted-at />
  </div>
</template>
