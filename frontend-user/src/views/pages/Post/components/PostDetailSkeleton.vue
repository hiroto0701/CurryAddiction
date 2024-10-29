<script setup lang="ts">
import ImgSkeleton from '@/views/molecules/skeletons/ImgSkeleton.vue';
import IconSkeleton from '@/views/molecules/skeletons/IconSkeleton.vue';
import TextSkeleton from '@/views/molecules/skeletons/TextSkeleton.vue';
</script>

<template>
  <div class="h-12"></div>
  <div class="xs:px-7 mx-auto w-full max-w-screen-md animate-pulse px-6 sm:px-10">
    <div class="pt-8">
      <div class="flex items-center gap-2.5">
        <IconSkeleton class="w-6" />
        <TextSkeleton class="w-40" />
      </div>
      <div class="mt-20 flex items-center gap-3 text-sumi-600">
        <IconSkeleton class="w-6" />
        <TextSkeleton class="w-40" />
        <TextSkeleton class="w-28" />
      </div>
    </div>

    <div class="xs:px-7 mx-auto mt-9 w-full max-w-screen-md px-6 sm:px-10">
      <div class="h-80 w-full">
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
