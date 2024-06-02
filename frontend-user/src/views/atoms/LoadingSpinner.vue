<script setup lang="ts">
interface Props {
  readonly isLoading?: boolean
}
defineProps<Props>()
</script>
<template>
  <div v-show="isLoading" class="flex justify-center" aria-label="読み込み中">
    <div
      class="animate-spin h-5 w-5 border-2 border-sky-400 rounded-full"
      style="border-top-color: transparent"
    ></div>
  </div>
</template>
