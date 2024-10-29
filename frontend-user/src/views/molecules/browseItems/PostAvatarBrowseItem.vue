<script setup lang="ts">
import PostAvatarIcon from '@/views/atoms/icons/PostAvatarIcon.vue';

interface Props {
  readonly avatarUrl: string | null;
}
defineProps<Props>();
</script>

<template>
  <div class="rounded-full border border-gray-300">
    <PostAvatarIcon :avatar-url />
  </div>
</template>
