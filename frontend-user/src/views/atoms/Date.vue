<script setup lang="ts">
interface Props {
  readonly date: string
}

defineProps<Props>()
</script>
<template>
  <span class="inline-block py-1 px-3 text-xs font-normal text-gray-500 absolute right-0">
    {{ date }}
  </span>
</template>
