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
    class="block w-full mt-3 text-sm border border-gray-300 p-3 pr-8 rounded-lg"
    :class="{
      'border-2': isError,
      'bg-red-100': isError,
      'border-red-400': isError
    }"
    placeholder="表示名を入力"
  />
</template>
