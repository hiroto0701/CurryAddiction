<script setup lang="ts">
import NotificationAvatarIcon from '@/views/atoms/icons/NotificationAvatarIcon.vue';

NotificationAvatarIcon;

interface Props {
  readonly avatarUrl: string | null;
}
defineProps<Props>();
</script>
<template>
  <div class="rounded-full border border-gray-300">
    <NotificationAvatarIcon :avatar-url />
  </div>
</template>
