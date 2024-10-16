<script setup lang="ts">
import { ref } from 'vue';
import { useCurryGenreStore } from '@/stores/curry_genre';
import type { FavoriteGenre } from '@/stores/account';
import type { FavoritePrefecture } from '@/stores/account';
import { PREFECTURE_LIST } from '@/constant/prefecture';
import SideBar from '@/views/molecules/SideBar.vue';
import CloseButton from '@/views/molecules/buttons/CloseButton.vue';
import PostFilterButton from '@/views/molecules/buttons/PostFilterButton.vue';
import GotoSettingPageButton from '@/views/molecules/buttons/GotoSettingPageButton.vue';

interface Props {
  readonly favoriteGenres: FavoriteGenre[];
  readonly favoritePrefectures: FavoritePrefecture[];
}
const props = defineProps<Props>();
const curryGenreStore = useCurryGenreStore();

const isMenuOpen = ref<boolean>(false);
</script>
<template>
  <SideBar v-model="isMenuOpen" position="right" :menu-component="PostFilterButton">
    <template #default="{ close }">
      <div class="flex items-center justify-between">
        <p class="font-body text-sm text-sumi-600">表示する投稿の絞り込み条件</p>
        <CloseButton @close="close" />
      </div>

      <ul v-if="props.favoriteGenres.length > 0" class="mt-8 flex flex-col gap-2.5">
        <li
          v-for="genre in props.favoriteGenres"
          :key="genre.genre_id"
          class="font-body text-sm text-sumi-600"
        >
          {{ curryGenreStore.state.genres.find((g) => g.id === genre.genre_id)?.name }}
        </li>
      </ul>

      <ul v-if="props.favoritePrefectures.length > 0" class="mt-8 flex flex-col gap-2.5">
        <li
          v-for="prefecture in props.favoritePrefectures"
          :key="prefecture.prefecture_id"
          class="font-body text-sm text-sumi-600"
        >
          {{ PREFECTURE_LIST.find((pref) => pref.prefId === prefecture.prefecture_id)?.name }}
        </li>
      </ul>

      <p class="mt-8 font-body text-xs leading-5 text-sumi-600" v-else>
        お気に入りのカレーのジャンルや地方・都道府県を登録することで、タイムラインに表示する投稿を絞り込むことができます。
      </p>
      <div class="mt-8 flex w-full justify-center">
        <GotoSettingPageButton text="設定へ" class="w-full" />
      </div>
    </template>
  </SideBar>
</template>
