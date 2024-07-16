<script setup lang="ts">
import PostList from '@/views/pages/Dashboard/Like/components/PostList.vue'
import PostListSkeleton from '@/views/pages/Dashboard/Like/components/PostListSkeleton.vue'
</script>
<template>
  <Suspense>
    <template #default>
      <PostList />
    </template>

    <template #fallback>
      <PostListSkeleton />
    </template>
  </Suspense>
</template>
