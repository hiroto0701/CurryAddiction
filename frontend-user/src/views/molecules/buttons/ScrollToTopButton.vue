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
  <div class="fixed right-14 max-md:right-3 bottom-9">
    <TopTooltip text="ページトップへ" position="top">
      <button
        @click="pageTop"
        class="peer flex justify-center items-center w-16 max-sm:w-14 aspect-square border border-gray-300 shadow-sm rounded-full bg-white opacity-70 sm:hover:bg-slate-100 sm:hover:opacity-100 duration-300"
      >
        <ArrowTopIcon class="text-sumi-900" />
      </button>
    </TopTooltip>
  </div>
</template>
