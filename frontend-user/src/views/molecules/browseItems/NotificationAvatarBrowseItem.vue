<script setup lang="ts">
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue';

interface Props {
  readonly avatarUrl: string | null;
}
defineProps<Props>();
</script>

<template>
  <div class="rounded-full border border-gray-300">
    <div class="h-10 w-10">
      <AvatarIcon :avatar-url />
    </div>
  </div>
</template>
