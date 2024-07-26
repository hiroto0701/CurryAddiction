<script setup lang="ts">
interface Props {
  readonly isLoading?: boolean
}
defineProps<Props>()
</script>
<template>
  <div v-show="isLoading" class="flex justify-center" aria-label="読み込み中">
    <div
      class="h-5 w-5 animate-spin rounded-full border-2 border-sky-400"
      style="border-top-color: transparent"
    ></div>
  </div>
</template>
