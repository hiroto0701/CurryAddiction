<script setup lang="ts">
import { ref, computed } from 'vue';
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue';
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue';
import LikedAnimationDots from '@/views/atoms/LikedAnimationDots.vue';

interface Props {
  readonly isLiked: boolean;
  readonly isArchived: boolean;
}
const props = defineProps<Props>();

const emits = defineEmits<{
  (e: 'like'): void;
  (e: 'archive'): void;
}>();

const localLikeState = ref<boolean>(props.isLiked);
const localArchiveState = ref<boolean>(props.isArchived);

const showLikeAnimation = computed((): boolean => {
  return !props.isLiked && localLikeState.value;
});

function toggleLike(): void {
  localLikeState.value = !localLikeState.value;
  emits('like');
}

function toggleArchive(): void {
  localArchiveState.value = !localArchiveState.value;
  emits('archive');
}
</script>

<template>
  <div class="flex h-fit justify-between px-1.5 py-1">
    <div
      @click.stop="toggleLike"
      class="relative flex h-9 w-9 cursor-pointer items-center justify-center rounded-full transition-opacity duration-500"
      :class="{
        'md:hover:bg-pink-50': localLikeState,
        'md:hover:bg-gray-100': !localLikeState
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
      @click.stop="toggleArchive"
      class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full transition-opacity duration-500 md:hover:bg-gray-100"
    >
      <ArchiveIcon
        class="cursor-pointer text-gray-700"
        :class="{ 'fill-gray-700': localArchiveState }"
      />
    </div>
  </div>
</template>
