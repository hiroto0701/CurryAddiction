<script setup lang="ts">
import DashBoardSideBar from '@/views/organisms/DashboardSideBar.vue';
</script>
<template>
  <div class="min-h-full font-body">
    <div class="flex items-start">
      <DashBoardSideBar />
      <main class="md:border-main-150 min-h-screen min-w-0 flex-1 pb-32 md:border-l">
        <div class="mx-auto mt-20 w-full max-w-screen-md px-5">
          <RouterView />
        </div>
      </main>
    </div>
  </div>
</template>
