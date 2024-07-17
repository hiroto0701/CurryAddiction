<script setup lang="ts">
import { ref, computed } from 'vue'
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'
import LikedAnimationDots from '@/views/atoms/LikedAnimationDots.vue'

interface Props {
  readonly isLiked: boolean
  readonly isArchived: boolean
}
const props = defineProps<Props>()

const emits = defineEmits<{
  (e: 'like'): void
  (e: 'archive'): void
}>()

const localLikeState = ref<boolean>(props.isLiked)

const showLikeAnimation = computed((): boolean => {
  return !props.isLiked && localLikeState.value
})

function toggleLike(): void {
  localLikeState.value = !localLikeState.value
  emits('like')
}
</script>
<template>
  <div class="flex justify-between h-fit px-1.5 py-1">
    <div
      @click.stop="toggleLike"
      class="w-8 h-8 relative rounded-full transition-opacity duration-500 cursor-pointer flex items-center justify-center"
      :class="{
        'hover:bg-pink-50': localLikeState,
        'hover:bg-gray-100': !localLikeState
      }"
    >
      <HeartIcon
        class="cursor-pointer"
        :class="{
          'text-transparent fill-red-400': localLikeState,
          'text-gray-700': !localLikeState
        }"
        :liked="showLikeAnimation"
      />
      <LikedAnimationDots v-show="showLikeAnimation" />
    </div>
    <div
      @click.stop="emits('archive')"
      class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
    >
      <ArchiveIcon class="text-gray-700 cursor-pointer" :archived="props.isArchived" />
    </div>
  </div>
</template>
