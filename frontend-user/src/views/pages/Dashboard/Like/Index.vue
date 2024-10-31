<script setup lang="ts">
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue';
import LikePagePlaceholder from '@/views/molecules/noContentPlaceholder/LikePagePlaceholder.vue';
import PostListSkeleton from '@/views/organisms/PostListSkeleton.vue';
import PostList from '@/views/organisms/PostList.vue';
</script>

<template>
  <DashboardContent title="いいねした投稿">
    <Suspense>
      <template #default>
        <PostList :placeholder-component="LikePagePlaceholder" page-type="like" />
      </template>

      <template #fallback>
        <PostListSkeleton />
      </template>
    </Suspense>
  </DashboardContent>
</template>
