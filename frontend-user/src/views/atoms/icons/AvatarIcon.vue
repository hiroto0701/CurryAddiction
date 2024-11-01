<script setup lang="ts">
import { computed } from 'vue';
import { useStorageUrl } from '@/composables/useStorageUrl';

const { getStorageUrl } = useStorageUrl();

interface Props {
  readonly preview?: string;
  readonly avatarUrl: string | null;
}
const props = defineProps<Props>();

const avatar = computed((): string => {
  if (props.avatarUrl === null) {
    return getStorageUrl('/avatar/default_avatar.jpg');
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
