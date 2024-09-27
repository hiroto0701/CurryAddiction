<script setup lang="ts">
import type { Component } from 'vue';
import FormErrorMessage from '@/views/atoms/ErrorMessage/FormErrorMessage.vue';
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue';
import FormLayout from '@/views/templates/FormLayout.vue';

interface Props {
  readonly label: string;
  readonly placeholder?: string;
  readonly required: boolean;
  readonly isError: boolean;
  readonly iconComponent: Component;
  readonly errors?: Record<string, string[]>;
}
defineProps<Props>();

const model = defineModel<string>();
</script>
<template>
  <FormLayout :label :required :iconComponent>
    <div class="relative">
      <input
        type="text"
        class="w-full rounded border border-gray-200 p-2 pr-9 font-body"
        :class="{
          'text-sumi-900': !isError,
          'text-red-400': isError,
          'border-red-400': isError,
          'bg-red-100': isError
        }"
        :placeholder
        v-model="model"
      />
      <ErrorIcon v-show="isError" class="absolute right-3 top-1/2 -translate-y-1/2" />
    </div>
    <div class="flex justify-between">
      <FormErrorMessage class="mt-1" field-name="storeName" :errors />
      <span
        class="flex justify-end"
        :class="{
          'text-sumi-500': !isError,
          'text-red-400': isError
        }"
      >
        {{ model ? model.length : 0 }} / 30
      </span>
    </div>
  </FormLayout>
</template>
