<script setup lang="ts">
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue'
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue'

const emits = defineEmits<{
  (e: 'hardDelete'): void
}>()
</script>
<template>
  <BottomTooltip text="完全に削除する" position="bottom">
    <button
      class="peer w-8 aspect-square rounded-full transition-opacity duration-500 hover:bg-gray-100 flex items-center justify-center"
      @click="emits('hardDelete')"
      aria-label="完全に削除する"
    >
      <TrashIcon />
    </button>
  </BottomTooltip>
</template>
