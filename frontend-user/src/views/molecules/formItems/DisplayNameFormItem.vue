<script setup lang="ts">
interface Props {
  readonly isError: boolean;
}
defineProps<Props>();

const model = defineModel<string>();
</script>
<template>
  <input
    type="text"
    v-model="model"
    class="mt-3 block w-full rounded-lg border border-gray-300 p-3 pr-8 text-sm"
    :class="{
      'border-2': isError,
      'bg-red-100': isError,
      'border-red-400': isError
    }"
    placeholder="表示名を入力"
  />
</template>
