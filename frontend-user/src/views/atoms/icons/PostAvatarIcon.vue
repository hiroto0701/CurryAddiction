<script setup lang="ts">
import { computed } from 'vue';

interface Props {
  readonly avatarUrl: string | null;
}
const prop = defineProps<Props>();

const avatar = computed((): string => {
  if (prop.avatarUrl === null) {
    return '../../../../public/icon/default_avatar.jpg';
  } else {
    return prop.avatarUrl;
  }
});
</script>

<template>
  <div class="w-7">
    <img
      :src="avatar"
      alt="プロフィール画像"
      class="aspect-square h-full w-full rounded-full bg-transparent object-cover"
    />
  </div>
</template>
