<script setup lang="ts">
import { ref, computed } from 'vue';
import { RouterLink, useRoute } from 'vue-router';
import type { RouteLocationNormalized, RouteLocationRaw } from 'vue-router';
import { useCommonStore } from '@/stores/common';
import BackButtonIcon from '@/views/atoms/icons/BackButtonIcon.vue';
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue';

const commonStore = useCommonStore();
const route = useRoute();
const referrer = ref<RouteLocationNormalized | null>(commonStore.state.originalRoute);

const linkDestination = computed<RouteLocationRaw>(() => {
  if (route.name === 'PostCreate' || !referrer.value) {
    return { name: 'Home' };
  } else {
    const { name, path, query, params } = referrer.value;
    return {
      name,
      path,
      query: { ...query },
      params: { ...params }
    };
  }
});

const tooltipText = computed(() => {
  return route.name === 'PostCreate' || !referrer.value ? 'ホームへ戻る' : '戻る';
});
</script>

<template>
  <BottomTooltip :text="tooltipText" position="bottom">
    <router-link
      :to="linkDestination"
      class="peer flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100"
    >
      <BackButtonIcon class="peer" />
    </router-link>
  </BottomTooltip>
</template>
