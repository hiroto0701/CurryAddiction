<script setup lang="ts">
import { ref } from 'vue';
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue';

interface Props {
  readonly label: string;
  readonly type: string;
  readonly isError: boolean;
}
defineProps<Props>();

const value = defineModel<string>();
const isFocused = ref<boolean>(false);
</script>

<template>
  <div class="relative w-full">
    <label
      :for="type"
      class="absolute pl-3 font-body font-semibold text-sumi-400 transition-all duration-300"
      :class="{
        'top-1 text-mini': isFocused || value,
        'top-5 text-sm': !isFocused && !value
      }"
    >
      {{ label }}
    </label>
    <input
      :type="type"
      :id="type"
      v-model="value"
      @focus="isFocused = true"
      @blur="isFocused = false"
      class="h-14 w-full rounded-lg border border-gray-300 px-3 pr-8 pt-4 font-body text-sumi-900 transition-all duration-300"
      :class="{
        'border-2': isError,
        'bg-red-100': isError,
        'border-red-400': isError
      }"
    />
    <ErrorIcon v-if="isError" class="absolute right-3 top-5" />
    <slot :value />
  </div>
</template>
