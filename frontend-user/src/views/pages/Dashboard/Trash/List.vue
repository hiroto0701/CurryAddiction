<script setup lang="ts">
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import TrashList from '@/views/pages/Dashboard/Trash/components/TrashList.vue'
</script>
<template>
  <DashboardContent title="ごみ箱">
    <Suspense>
      <template #default>
        <TrashList />
      </template>

      <template #fallback>
        <!-- <PostListSkeleton /> -->
        <p>loading......</p>
      </template>
    </Suspense>
  </DashboardContent>
</template>
