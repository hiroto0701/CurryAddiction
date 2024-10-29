<script setup lang="ts">
interface Props {
  readonly src: string;
}
defineProps<Props>();
</script>

<template>
  <img :src alt="コンテンツが空の時イラスト" />
</template>
