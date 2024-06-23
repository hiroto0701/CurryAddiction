<script setup lang="ts">
import ImgSkeleton from '@/views/molecules/skeletons/ImgSkeleton.vue'
import IconSkeleton from '@/views/molecules/skeletons/IconSkeleton.vue'
import TextSkeleton from '@/views/molecules/skeletons/TextSkeleton.vue'
</script>
<template>
  <div class="h-12"></div>
  <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md animate-pulse">
    <div class="pt-8">
      <div class="flex gap-2.5 items-center">
        <IconSkeleton />
        <TextSkeleton class="w-40" />
      </div>
      <div class="mt-20 flex items-center text-sumi-600 gap-3">
        <IconSkeleton />
        <TextSkeleton class="w-40" />
        <TextSkeleton class="w-28" />
      </div>
    </div>

    <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md mt-9">
      <div class="w-full h-80">
        <ImgSkeleton />
      </div>
      <div class="my-12 flex flex-col gap-3">
        <TextSkeleton class="w-full" />
        <TextSkeleton class="w-full" />
        <TextSkeleton class="w-full" />
        <TextSkeleton class="w-full" />
        <TextSkeleton class="w-full" />
      </div>
    </div>
  </div>
</template>
