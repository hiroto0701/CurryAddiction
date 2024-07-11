<script setup lang="ts">
import IconSkeleton from '@/views/molecules/skeletons/IconSkeleton.vue'
import TextSkeleton from '@/views/molecules/skeletons/TextSkeleton.vue'
</script>
<template>
  <div class="flex gap-5 sm:gap-7 animate-pulse">
    <div class="w-[90px] h-[110px] bg-slate-200 border border-gray-200 rounded-lg"></div>
    <div class="flex-1">
      <TextSkeleton class="w-28" />
      <div class="mt-5">
        <TextSkeleton class="w-32" />
        <div class="mt-5 flex items-center gap-2.5">
          <TextSkeleton class="w-20 h-8" />
          <IconSkeleton class="w-6" />
        </div>
      </div>
    </div>
  </div>
</template>
