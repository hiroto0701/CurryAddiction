<script setup lang="ts">
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue';
import ArchivePagePlaceholder from '@/views/molecules/noContentPlaceholder/ArchivePagePlaceholder.vue';
import PostListSkeleton from '@/views/organisms/PostListSkeleton.vue';
import PostList from '@/views/organisms/PostList.vue';
</script>

<template>
  <DashboardContent title="保存した投稿">
    <Suspense>
      <template #default>
        <PostList :placeholder-component="ArchivePagePlaceholder" page-type="archive" />
      </template>

      <template #fallback>
        <PostListSkeleton />
      </template>
    </Suspense>
  </DashboardContent>
</template>
