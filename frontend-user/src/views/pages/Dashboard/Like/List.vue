<script setup lang="ts">
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue';
import PostList from '@/views/pages/Dashboard/Like/components/PostList.vue';
import PostListSkeleton from '@/views/pages/Dashboard/Like/components/PostListSkeleton.vue';
</script>
<template>
  <DashboardContent title="いいねした投稿">
    <Suspense>
      <template #default>
        <PostList />
      </template>

      <template #fallback>
        <PostListSkeleton />
      </template>
    </Suspense>
  </DashboardContent>
</template>
