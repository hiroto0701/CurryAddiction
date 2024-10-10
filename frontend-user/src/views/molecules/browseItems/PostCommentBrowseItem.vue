<script setup lang="ts">
import CommentIcon from '@/views/atoms/icons/CommentIcon.vue';

interface Props {
  readonly comment?: string;
}

defineProps<Props>();
</script>
<template>
  <div>
    <div class="mb-3 flex items-center gap-2">
      <CommentIcon />
      <h3 class="font-body font-medium leading-relaxed text-sumi-700">感想</h3>
    </div>
    <p v-if="comment" class="font-body leading-relaxed text-sumi-900" style="white-space: pre-wrap">
      {{ comment }}
    </p>
    <p v-else class="font-body leading-relaxed text-sumi-900">感想はありません💭</p>
  </div>
</template>
