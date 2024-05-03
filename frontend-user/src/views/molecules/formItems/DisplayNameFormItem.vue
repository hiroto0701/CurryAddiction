<script setup lang="ts">
interface Props {
  readonly isError: boolean
}
defineProps<Props>()
const model = defineModel<string | null>()
</script>
<template>
  <input 
    type="text" 
    v-model="model"
    class="block w-full mt-3 text-sm border bg-red border-gray-300 p-3 rounded-lg"
    :class="{ 
      'border-2': isError,
      'bg-red-100': isError,
      'border-red-400': isError
    }" 
  />
</template>
