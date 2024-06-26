<script setup lang="ts">
import ImgSkeleton from '@/views/molecules/skeletons/ImgSkeleton.vue'
import IconSkeleton from '@/views/molecules/skeletons/IconSkeleton.vue'
import TextSkeleton from '@/views/molecules/skeletons/TextSkeleton.vue'
</script>
<template>
  <div class="h-80 rounded-lg overflow-hidden border border-gray-200 animate-pulse">
    <div class="w-full h-52 border-gray-200">
      <ImgSkeleton />
    </div>
    <div class="flex flex-col justify-between h-28 py-2 animate-pulse">
      <div class="flex justify-between h-fit px-1.5 py-1">
        <TextSkeleton class="w-20" />
        <TextSkeleton class="w-20" />
      </div>
      <div class="px-3 py-1 h-fit flex items-center gap-2.5">
        <IconSkeleton class="w-6" />
        <TextSkeleton class="w-28" />
      </div>
      <div class="flex justify-between items-center mr-2">
        <div class="px-3 py-1 flex items-center gap-2.5 relative">
          <IconSkeleton class="w-6" />
          <TextSkeleton class="w-16" />
        </div>
        <TextSkeleton class="w-20" />
      </div>
    </div>
  </div>
</template>
