<script setup lang="ts">
import { ref, computed } from 'vue';
import { useCurryGenreStore } from '@/stores/curry_genre';
import type { FavoriteGenre, FavoritePrefecture } from '@/types/favorite';
import { PREFECTURE_LIST } from '@/constant/prefecture';
import GenreIcon from '@/views/atoms/icons/GenreIcon.vue';
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue';
import SideBarSectionTitle from '@/views/molecules/SideBarSectionTitle.vue';
import SideBar from '@/views/molecules/SideBar.vue';
import CloseButton from '@/views/molecules/buttons/CloseButton.vue';
import PostFilterButton from '@/views/molecules/buttons/PostFilterButton.vue';
import GotoSettingPageButton from '@/views/molecules/buttons/GotoSettingPageButton.vue';

interface Props {
  readonly favoriteGenres: FavoriteGenre[];
  readonly favoritePrefectures: FavoritePrefecture[];
}
const props = defineProps<Props>();

interface PrefectureDetail {
  prefId: number;
  name: string;
  regionId: number;
  regionName: string;
}

interface GroupedRegion {
  regionId: number;
  regionName: string;
  prefectures: PrefectureDetail[];
}

const curryGenreStore = useCurryGenreStore();

const isMenuOpen = ref<boolean>(false);

const groupedPrefectures = computed((): GroupedRegion[] => {
  const groupedByRegion: Record<string, GroupedRegion> = {};

  props.favoritePrefectures.forEach((favPref) => {
    const prefDetail = PREFECTURE_LIST.find((pref) => pref.prefId === favPref.prefecture_id);
    if (prefDetail) {
      if (!groupedByRegion[prefDetail.regionName]) {
        groupedByRegion[prefDetail.regionName] = {
          regionId: prefDetail.regionId,
          regionName: prefDetail.regionName,
          prefectures: []
        };
      }
      groupedByRegion[prefDetail.regionName].prefectures.push(prefDetail);
    }
  });

  return Object.values(groupedByRegion).sort((a, b) => a.regionId - b.regionId);
});
</script>
<template>
  <SideBar v-model="isMenuOpen" position="right" :menu-component="PostFilterButton">
    <template #default="{ close }">
      <div class="flex items-center justify-between">
        <h2 class="font-body text-sm text-sumi-600">表示する投稿の絞り込み条件</h2>
        <CloseButton @close="close" />
      </div>

      <div v-if="props.favoriteGenres.length > 0" class="mt-8 flex flex-col gap-2.5">
        <SideBarSectionTitle :icon="GenreIcon" title="ジャンル" />

        <ul class="flex list-none flex-col gap-2.5 p-0">
          <li
            v-for="genre in props.favoriteGenres"
            :key="genre.genre_id"
            class="font-body text-sm text-sumi-600"
          >
            {{ curryGenreStore.state.genres.find((g) => g.id === genre.genre_id)?.name }}
          </li>
        </ul>
      </div>

      <div v-if="groupedPrefectures.length > 0" class="mt-8 flex flex-col gap-2.5">
        <SideBarSectionTitle :icon="LocationIcon" title="地方・都道府県" />

        <details v-for="region in groupedPrefectures" :key="region.regionId">
          <summary class="w-fit cursor-pointer font-body text-sm text-sumi-600">
            {{ region.regionName }}
            <span class="ml-1 font-body text-sm text-sumi-600">
              ({{ region.prefectures.length }})
            </span>
          </summary>
          <ul class="mt-2 flex list-none flex-col gap-2.5 pl-4">
            <li
              v-for="prefecture in region.prefectures"
              :key="prefecture.prefId"
              class="font-body text-sm text-sumi-600"
            >
              {{ prefecture.name }}
            </li>
          </ul>
        </details>
      </div>

      <p
        class="mt-8 font-body text-xs leading-5 text-sumi-600"
        v-if="props.favoriteGenres.length === 0 || props.favoritePrefectures.length === 0"
      >
        お気に入りのカレーのジャンルや地方・都道府県を登録することで、タイムラインに表示する投稿を絞り込むことができます。
      </p>
      <div class="mt-8 flex w-full justify-center">
        <GotoSettingPageButton text="設定へ" class="w-full" />
      </div>
    </template>
  </SideBar>
</template>
