<script setup lang="ts">
import DashBoardSideBar from '@/views/organisms/DashboardSideBar.vue'
</script>

<template>
  <div class="min-h-full font-body">
    <div class="flex items-start">
      <DashBoardSideBar />
      <main class="min-h-screen min-w-0 flex-1 pb-32 md:border-l md:border-main-150">
        <div class="mx-auto w-full px-5 max-w-screen-md mt-20">
          <RouterView />
        </div>
      </main>
    </div>
  </div>
</template>
