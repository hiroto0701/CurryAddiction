<script setup lang="ts">
interface Props {
  readonly src: string
}

defineProps<Props>()
</script>
<template>
  <div class="h-96 w-full border-gray-200 sm:h-60">
    <img class="h-full w-full select-none object-cover" :src alt="カレーの画像" />
  </div>
</template>
