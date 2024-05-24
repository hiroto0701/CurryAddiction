<script setup lang="ts">
interface Props {
  readonly isError: boolean
}
defineProps<Props>()

const model = defineModel<string>()
</script>
<template>
  <input 
    type="text" 
    v-model="model"
    class="block font-body text-sumi-900 p-3 rounded-lg border border-gray-300 focus:border"
    :class="{ 
      'border-2': isError,
      'bg-red-100': isError,
      'border-red-400': isError
    }"
    placeholder="example"
  />
</template>
