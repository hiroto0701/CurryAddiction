<script setup lang="ts">
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import TrashedList from '@/views/pages/Dashboard/components/TrashedList.vue'
</script>
<template>
  <DashboardContent title="ごみ箱">
    <div class="grid grid-cols-1 gap-8">
      <TrashedList />
    </div>
  </DashboardContent>
</template>
