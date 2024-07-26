<script setup lang="ts">
interface Props {
  readonly handleName: null | string
}

defineProps<Props>()
</script>
<template>
  <p class="inline-flex font-body text-sm text-sumi-500">curry-addiction/{{ handleName }}</p>
</template>
