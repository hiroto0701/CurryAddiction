<script setup lang="ts">
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'
import LikedHeartIcon from '@/views/atoms/icons/LikedHeartIcon.vue'
import LikedAnimationDots from '@/views/atoms/LikedAnimationDots.vue'

interface Props {
  readonly isLiked: boolean
  readonly isArchived: boolean
}
defineProps<Props>()

const emits = defineEmits<{
  (e: 'like'): void
  (e: 'archive'): void
}>()
</script>
<template>
  <div class="flex justify-between h-fit px-1.5 py-1">
    <div
      @click.stop="emits('like')"
      class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
      v-show="!isLiked"
    >
      <HeartIcon class="text-gray-700 cursor-pointer" />
    </div>
    <div
      @click.stop="emits('like')"
      class="w-8 h-8 relative rounded-full transition-opacity duration-500 cursor-pointer hover:bg-pink-50 flex items-center justify-center"
      v-show="isLiked"
    >
      <LikedHeartIcon class="text-transparent cursor-pointer fill-red-400" :liked="isLiked" />
      <LikedAnimationDots />
    </div>
    <div
      @click.stop="emits('archive')"
      class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
    >
      <ArchiveIcon class="text-gray-700 cursor-pointer" :archived="isArchived" />
    </div>
  </div>
</template>
