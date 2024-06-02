<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'

interface Props {
  readonly text: string
}
defineProps<Props>()
</script>
<template>
  <BaseButton
    type="submit"
    class="mt-5 w-full py-3 px-10 bg-sky-500 hover:bg-sky-500 text-white font-semibold"
    :text
  />
</template>
