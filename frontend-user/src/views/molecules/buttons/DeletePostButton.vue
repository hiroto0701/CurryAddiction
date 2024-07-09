<script setup lang="ts">
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue'
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue'

interface Props {
  readonly text: string
}
defineProps<Props>()

const emits = defineEmits<{
  (e: 'delete'): void
}>()
</script>
<template>
  <BottomTooltip :text position="bottom">
    <button
      class="peer group w-8 aspect-square rounded-full transition-opacity duration-500 hover:bg-gray-100 flex items-center justify-center"
      @click="emits('delete')"
      :aria-label="text"
    >
      <TrashIcon class="text-sumi-600 group-hover:text-sumi-900" />
    </button>
  </BottomTooltip>
</template>
