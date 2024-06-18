<script setup lang="ts">
interface Props {
  readonly date: string
  readonly formattedDate: string
}
defineProps<Props>()
</script>
<template>
  <time class="flex min-w-0 justify-items-end items-center font-body" :datetime="date">
    {{ formattedDate }}
  </time>
</template>
