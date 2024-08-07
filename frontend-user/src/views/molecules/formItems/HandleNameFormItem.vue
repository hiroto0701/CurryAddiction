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
    class="block rounded-lg border border-gray-300 p-3 font-body text-sumi-900 focus:border"
    :class="{
      'border-2': isError,
      'bg-red-100': isError,
      'border-red-400': isError
    }"
    placeholder="example"
  />
</template>
