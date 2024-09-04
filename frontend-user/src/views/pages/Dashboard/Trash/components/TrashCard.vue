<script setup lang="ts">
import TrashCardPreview from '@/views/pages/Dashboard/Trash/components/TrashCardPreview.vue';
import TrashCardDetails from '@/views/pages/Dashboard/Trash/components/TrashCardDetails.vue';

interface Props {
  readonly src: string;
  readonly storeName: string;
  readonly deletedAt: string;
  readonly comment?: string;
}
defineProps<Props>();

const emits = defineEmits<{
  (e: 'delete'): void;
  (e: 'restore'): void;
}>();
</script>
<template>
  <div class="flex gap-5 sm:gap-7">
    <TrashCardPreview :src="src" :store-name="storeName" :comment="comment" />
    <TrashCardDetails
      :store-name="storeName"
      :deleted-at="deletedAt"
      @delete="emits('delete')"
      @restore="emits('restore')"
    />
  </div>
</template>
