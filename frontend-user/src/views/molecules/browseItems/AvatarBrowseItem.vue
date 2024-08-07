<script setup lang="ts">
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue';

interface Props {
  readonly preview?: string;
  readonly avatarUrl: string | null;
}
defineProps<Props>();
</script>
<template>
  <div class="relative rounded-full border border-gray-300">
    <AvatarIcon :preview :avatar-url />
  </div>
</template>
