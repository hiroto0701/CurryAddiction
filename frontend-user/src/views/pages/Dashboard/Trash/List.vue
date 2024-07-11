<script setup lang="ts">
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import TrashList from '@/views/pages/Dashboard/Trash/components/TrashList.vue'
import TrashListSkeleton from '@/views/pages/Dashboard/Trash/components/TrashListSkeleton.vue'
</script>
<template>
  <DashboardContent title="ごみ箱">
    <Suspense>
      <template #default>
        <TrashList />
      </template>

      <template #fallback>
        <TrashListSkeleton />
      </template>
    </Suspense>
  </DashboardContent>
</template>
