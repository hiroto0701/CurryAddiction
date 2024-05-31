<script setup lang="ts">
interface Props {
  readonly signUpDate: string
}

defineProps<Props>()
</script>
<template>
  <p class="flex min-w-0 flex-1 items-center font-body text-sumi-900 text-sm">{{ signUpDate }}</p>
</template>
