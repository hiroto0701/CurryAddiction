<script setup lang="ts">
import { computed } from 'vue';

interface Props {
  readonly preview?: string;
  readonly avatarUrl: string | null;
}
const props = defineProps<Props>();

const avatar = computed((): string => {
  if (props.avatarUrl === null) {
    return 'http://localhost:9000/local-curry_addiction/avatar/default_avatar.jpg';
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
    :src="avatar"
    alt="プロフィール画像"
    class="aspect-square rounded-full bg-transparent object-cover"
  />
</template>
