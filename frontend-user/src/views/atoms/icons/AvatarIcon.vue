<script setup lang="ts">
import { computed } from 'vue';

interface Props {
  readonly preview?: string;
  readonly avatarUrl: string | null;
}
const props = defineProps<Props>();

const avatar_url = computed((): string => {
  if (props.avatarUrl === null) {
    const defaultAvatar = 'http://localhost:9000/local-curry_addiction/avatar/default_avatar.jpg';
    return defaultAvatar;
  } else {
    return props.avatarUrl;
  }
});
</script>
<template>
  <img
    v-show="preview"
    :src="preview"
    alt="プロフィール画像"
    class="aspect-square rounded-full bg-transparent object-cover"
  />

  <img
    v-show="!preview"
    :src="avatar_url"
    alt="プロフィール画像"
    class="aspect-square rounded-full bg-transparent object-cover"
  />
</template>
