<script setup lang="ts">
import { MenuButton } from '@headlessui/vue';
import NotificationIcon from '@/views/atoms/icons/NotificationIcon.vue';
</script>
<template>
  <MenuButton aria-label="通知一覧を開く">
    <NotificationIcon class="flex items-center justify-center" />
  </MenuButton>
</template>
