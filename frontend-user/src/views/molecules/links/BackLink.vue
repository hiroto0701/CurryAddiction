<script setup lang="ts">
import { ref, computed } from 'vue'
import { RouterLink } from 'vue-router'
import type { RouteLocationNormalized, RouteLocationRaw } from 'vue-router'
import { useCommonStore } from '@/stores/common'
import BackButtonIcon from '@/views/atoms/icons/BackButtonIcon.vue'
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue'

const commonStore = useCommonStore()
const referrer = ref<RouteLocationNormalized | null>(commonStore.state.originalRoute)

const linkDestination = computed<RouteLocationRaw>(() => {
  if (referrer.value) {
    const { name, path, query, params } = referrer.value
    return {
      name,
      path,
      query: { ...query },
      params: { ...params }
    }
  } else {
    return { name: 'Home' }
  }
})
</script>
<template>
  <BottomTooltip text="戻る" position="bottom">
    <router-link
      :to="linkDestination"
      class="peer flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100"
    >
      <BackButtonIcon class="peer" />
    </router-link>
  </BottomTooltip>
</template>
