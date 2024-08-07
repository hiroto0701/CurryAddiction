<script setup lang="ts">
import ImgSkeleton from '@/views/molecules/skeletons/ImgSkeleton.vue';
import IconSkeleton from '@/views/molecules/skeletons/IconSkeleton.vue';
import TextSkeleton from '@/views/molecules/skeletons/TextSkeleton.vue';
</script>
<template>
  <div class="h-80 animate-pulse overflow-hidden rounded-lg border border-gray-200">
    <div class="h-52 w-full border-gray-200">
      <ImgSkeleton />
    </div>
    <div class="flex h-28 animate-pulse flex-col justify-between py-2">
      <div class="flex h-fit justify-between px-1.5 py-1">
        <TextSkeleton class="w-20" />
        <TextSkeleton class="w-20" />
      </div>
      <div class="flex h-fit items-center gap-2.5 px-3 py-1">
        <IconSkeleton class="w-6" />
        <TextSkeleton class="w-28" />
      </div>
      <div class="mr-2 flex items-center justify-between">
        <div class="relative flex items-center gap-2.5 px-3 py-1">
          <IconSkeleton class="w-6" />
          <TextSkeleton class="w-16" />
        </div>
        <TextSkeleton class="w-20" />
      </div>
    </div>
  </div>
</template>
