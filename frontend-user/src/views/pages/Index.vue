<script setup lang="ts">
import HomePagePlaceholder from '@/views/molecules/noContentPlaceholder/HomePagePlaceholder.vue';
import PostList from '@/views/organisms/PostList.vue';
import PostListSkeleton from '@/views/organisms/PostListSkeleton.vue';
</script>

<template>
  <Suspense>
    <template #default>
      <PostList :placeholder-component="HomePagePlaceholder" page-type="home" />
    </template>

    <template #fallback>
      <PostListSkeleton />
    </template>
  </Suspense>
</template>
