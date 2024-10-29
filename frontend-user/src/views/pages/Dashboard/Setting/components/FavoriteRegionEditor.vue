<script setup lang="ts">
import { computed } from 'vue';
import { useCommonStore } from '@/stores/common';
import { PREFECTURE_LIST } from '@/constant/prefecture';
import UpdateButton from '@/views/molecules/buttons/UpdateButton.vue';
import CancelButton from '@/views/molecules/buttons/CancelButton.vue';

const commonStore = useCommonStore();
const model = defineModel<number[]>();

const groupedPrefectures = computed(() => {
  const grouped = PREFECTURE_LIST.reduce(
    (acc, cur) => {
      if (!acc[cur.regionId]) {
        acc[cur.regionId] = {
          regionId: cur.regionId,
          regionName: cur.regionName,
          prefectures: [],
          favoriteCount: 0
        };
      }
      acc[cur.regionId].prefectures.push(cur);
      if (model.value?.includes(cur.prefId)) {
        acc[cur.regionId].favoriteCount++;
      }
      return acc;
    },
    {} as Record<
      number,
      {
        regionId: number;
        regionName: string;
        prefectures: typeof PREFECTURE_LIST;
        favoriteCount: number;
      }
    >
  );

  return Object.values(grouped);
});

const emits = defineEmits<{
  (e: 'update'): void;
  (e: 'cancel'): void;
}>();
</script>

<template>
  <div class="flex flex-col gap-5">
    <details v-for="region in groupedPrefectures" :key="region.regionId">
      <summary class="w-fit cursor-pointer font-body text-sm text-sumi-800">
        {{ region.regionName }}
        <span v-if="region.favoriteCount > 0" class="ml-2 font-body text-sm text-sumi-600">
          ({{ region.favoriteCount }})
        </span>
      </summary>
      <div class="grid grid-cols-3 gap-1">
        <div
          v-for="prefecture in region.prefectures"
          :key="prefecture.prefId"
          class="flex items-center px-3 pt-3"
        >
          <input
            type="checkbox"
            class="mr-2 h-4 w-4 cursor-pointer"
            :id="prefecture.prefId.toString()"
            :value="prefecture.prefId"
            v-model="model"
            :checked="model?.includes(prefecture.prefId)"
          />
          <label
            :for="prefecture.prefId.toString()"
            class="cursor-pointer font-body text-sm text-sumi-700"
          >
            {{ prefecture.name }}
          </label>
        </div>
      </div>
    </details>
    <div class="flex items-center gap-2">
      <UpdateButton
        class="inline-flex items-center justify-center px-4 py-3 text-sm"
        :is-loading="commonStore.state.apiLoading"
        :disabled="commonStore.state.apiLoading"
        @click="emits('update')"
      />
      <CancelButton
        class="inline-flex items-center justify-center px-4 py-3 text-sm"
        @click="emits('cancel')"
      />
    </div>
  </div>
</template>
