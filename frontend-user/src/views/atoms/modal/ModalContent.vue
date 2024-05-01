<script setup lang="ts">
interface Props {
  readonly content: string | null
}

defineProps<Props>()
</script>
<template>
   <p class="font-body w-fit mx-auto text-sumi-500 text-sm">{{ content }}</p>
</template>