<script setup lang="ts">
import { ref } from 'vue';
import { tv } from 'tailwind-variants';
import { useCurryGenreStore } from '@/stores/curry_genre';
import type { FavoriteGenre } from '@/stores/account';
import CrossIcon from '@/views/atoms/icons/CrossIcon.vue';
import PostFilterButton from '@/views/molecules/buttons/PostFilterButton.vue';

interface Props {
  favoriteGenres: FavoriteGenre[];
}
defineProps<Props>();
const curryGenreStore = useCurryGenreStore();

const isMenuOpen = ref<boolean>(false);

function openMenu(): void {
  isMenuOpen.value = true;
}

function closeMenu(): void {
  isMenuOpen.value = false;
}

const sidebar = tv({
  base: 'fixed right-0 top-0 z-20 h-full transform overflow-y-auto bg-slate-100 p-5 transition-transform duration-300 ease-in-out',
  variants: {
    isOpen: {
      true: 'translate-x-0',
      false: 'translate-x-full'
    }
  },
  defaultVariants: {
    isOpen: false
  }
});

const overlay = tv({
  base: 'fixed inset-0 z-10 bg-black bg-opacity-50',
  variants: {
    visibility: {
      hidden: 'hidden'
    }
  }
});
</script>
<template>
  <PostFilterButton @toggle-menu="openMenu" />
  <aside :class="sidebar({ isOpen: isMenuOpen })" style="width: 258px">
    <div class="flex items-center justify-between">
      <p class="font-body text-sm text-sumi-600">表示中のカレーのジャンル</p>
      <button
        class="group flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-200"
        @click="closeMenu"
      >
        <CrossIcon class="w-5 text-sumi-600 group-hover:text-sumi-900" />
      </button>
    </div>

    <ul>
      <li
        v-for="genre in favoriteGenres"
        :key="genre.genre_id"
        class="py-2 font-body text-sm text-sumi-600"
      >
        {{ curryGenreStore.state.genres.find((g) => g.id === genre.genre_id)?.name }}
      </li>
    </ul>
  </aside>

  <div v-if="isMenuOpen" :class="overlay()" @click="closeMenu"></div>
</template>
