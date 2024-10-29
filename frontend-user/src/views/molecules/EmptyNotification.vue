<script setup lang="ts">
import EmptyNotificationIcon from '@/views/atoms/icons/EmptyNotificationIcon.vue';
</script>

<template>
  <div class="flex h-40 w-full flex-col items-center justify-center gap-3 p-5 text-utility">
    <EmptyNotificationIcon class="w-10" />
    <p class="font-body text-utility">通知はありません</p>
  </div>
</template>
