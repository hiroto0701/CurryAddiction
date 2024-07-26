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
  <div class="flex h-fit justify-between px-1.5 py-1">
    <div
      @click.stop="toggleLike"
      class="relative flex h-8 w-8 cursor-pointer items-center justify-center rounded-full transition-opacity duration-500"
      :class="{
        'hover:bg-pink-50': localLikeState,
        'hover:bg-gray-100': !localLikeState
      }"
    >
      <HeartIcon
        class="cursor-pointer"
        :class="{
          'fill-red-400 text-red-400': localLikeState,
          'text-gray-700': !localLikeState
        }"
        :liked="showLikeAnimation"
      />
      <LikedAnimationDots v-show="showLikeAnimation" />
    </div>
    <div
      @click.stop="emits('archive')"
      class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100"
    >
      <ArchiveIcon
        class="cursor-pointer text-gray-700"
        :class="{ 'fill-gray-700': props.isArchived }"
      />
    </div>
  </div>
</template>
