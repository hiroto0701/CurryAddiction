<script setup lang="ts">
import PostDetail from '@/views/pages/Post/components/PostDetail.vue'
import PostDetailSkeleton from '@/views/pages/Post/components/PostDetailSkeleton.vue'
</script>
<template>
  <Suspense>
    <template #default>
      <PostDetail />
    </template>

    <template #fallback>
      <PostDetailSkeleton />
    </template>
  </Suspense>
</template>
