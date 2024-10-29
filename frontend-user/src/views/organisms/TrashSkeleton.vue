<script setup lang="ts">
import IconSkeleton from '@/views/molecules/skeletons/IconSkeleton.vue';
import TextSkeleton from '@/views/molecules/skeletons/TextSkeleton.vue';
</script>

<template>
  <div class="flex animate-pulse gap-5 sm:gap-7">
    <div class="h-[110px] w-[90px] rounded-lg border border-gray-200 bg-slate-200"></div>
    <div class="flex-1">
      <TextSkeleton class="w-28" />
      <div class="mt-5">
        <TextSkeleton class="w-32" />
        <div class="mt-5 flex items-center gap-2.5">
          <TextSkeleton class="h-8 w-20" />
          <IconSkeleton class="w-6" />
        </div>
      </div>
    </div>
  </div>
</template>
