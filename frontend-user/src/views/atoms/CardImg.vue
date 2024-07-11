<script setup lang="ts">
interface Props {
  readonly src: string
}

defineProps<Props>()
</script>
<template>
  <div class="w-full sm:h-52 h-96 border-gray-200">
    <img class="w-full h-full object-cover select-none" :src alt="カレーの画像" />
  </div>
</template>
