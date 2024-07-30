<script setup lang="ts">
import ArrowTopIcon from '@/views/atoms/icons/ArrowTopIcon.vue'
import TopTooltip from '@/views/molecules/tooltips/TopTooltip.vue'

function pageTop(): void {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
}
</script>
<template>
  <div class="fixed bottom-9 right-3 z-40 md:right-14">
    <TopTooltip text="ページトップへ" position="top">
      <button
        @click="pageTop"
        class="peer flex aspect-square w-16 items-center justify-center rounded-full border border-gray-300 bg-white opacity-70 shadow-sm duration-300 max-sm:w-14 sm:hover:bg-slate-100 sm:hover:opacity-100"
        aria-label="ページトップへスクロール"
      >
        <ArrowTopIcon class="text-sumi-900" />
      </button>
    </TopTooltip>
  </div>
</template>
