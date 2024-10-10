<script setup lang="ts">
interface Props {
  readonly postImg: string;
}
defineProps<Props>();
</script>
<template>
  <img :src="postImg" alt="投稿画像" />
</template>
