<script setup lang="ts">
import IconSkeleton from '@/views/molecules/skeletons/IconSkeleton.vue';
import TextSkeleton from '@/views/molecules/skeletons/TextSkeleton.vue';
</script>

<template>
  <div class="mb-12 animate-pulse overflow-hidden rounded-2xl border border-gray-200 p-6 md:p-7">
    <div class="flex items-center gap-3.5 py-6">
      <IconSkeleton class="w-24" />
      <div class="flex flex-1 flex-col gap-3">
        <TextSkeleton class="w-40" />
        <TextSkeleton class="w-44" />
      </div>
    </div>
    <div class="flex min-h-14 items-center">
      <div class="flex items-center">
        <span class="inline-flex w-7 items-center">
          <IconSkeleton class="w-6" />
        </span>
        <span class="w-28"><TextSkeleton class="w-20" /></span>
      </div>
      <TextSkeleton class="w-44" />
    </div>
    <div class="flex min-h-14 items-center border-t">
      <div class="flex items-center">
        <span class="inline-flex w-7 items-center">
          <IconSkeleton class="w-6" />
        </span>
        <span class="w-28"><TextSkeleton class="w-20" /></span>
      </div>
      <TextSkeleton class="w-44" />
    </div>
  </div>
</template>
