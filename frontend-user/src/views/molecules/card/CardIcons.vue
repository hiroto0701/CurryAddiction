<script setup lang="ts">
import { ref } from 'vue'
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'
import LikedHeartIcon from '@/views/atoms/icons/LikedHeartIcon.vue'
import LikedAnimationDots from '@/views/atoms/LikedAnimationDots.vue'

const liked = ref<boolean>(false)
const archived = ref<boolean>(false)

function toggleLike(): void {
  liked.value = !liked.value
}

function toggleArchive(): void {
  archived.value = !archived.value
}
</script>
<template>
  <div class="flex justify-between h-fit px-1.5 py-1">
    <div
      @click.stop="toggleLike"
      class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
      v-show="!liked"
    >
      <HeartIcon class="text-gray-700 cursor-pointer" />
    </div>
    <div
      @click.stop="toggleLike"
      class="w-8 h-8 relative rounded-full transition-opacity duration-500 cursor-pointer hover:bg-pink-50 flex items-center justify-center"
      v-show="liked"
    >
      <LikedHeartIcon class="text-transparent cursor-pointer fill-red-400" :liked="liked" />
      <LikedAnimationDots />
    </div>
    <div
      @click.stop="toggleArchive"
      class="w-8 h-8 rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
    >
      <ArchiveIcon class="text-gray-700 cursor-pointer" :archived="archived" />
    </div>
  </div>
</template>
