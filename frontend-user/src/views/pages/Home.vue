<script setup lang="ts">
import PostList from '@/views/pages/Post/components/PostList.vue';
import PostListSkeleton from '@/views/pages/Post/components/PostListSkeleton.vue';
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
