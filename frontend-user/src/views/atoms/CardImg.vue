<script setup lang="ts">
interface Props {
  readonly src: string
}

defineProps<Props>()
</script>
<template>
  <div class="w-full h-52 border-gray-200">
    <img class="w-full h-full object-cover" :src alt="カレーの画像" />
  </div>
</template>
