<script setup lang="ts">
interface Props {
  readonly src: string
}
defineProps<Props>()
</script>
<template>
  <img :src alt="" class="w-5 aspect-square" />
</template>
