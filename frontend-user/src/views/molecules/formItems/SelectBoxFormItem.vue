<script setup lang="ts">
import type { Component } from 'vue';
import type { Genre } from '@/types/genre';
import FormErrorMessage from '@/views/atoms/ErrorMessage/FormErrorMessage.vue';
import FormLayout from '@/views/templates/FormLayout.vue';

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly iconComponent: Component;
  readonly errors?: Record<string, string[]>;
  readonly options: Genre[];
}

defineProps<Props>();

const modelValue = defineModel<number | undefined>();
</script>
<template>
  <FormLayout :label :required :iconComponent>
    <select
      v-model="modelValue"
      name="genre"
      class="block w-60 rounded-md border border-gray-200 p-2 font-body text-sm text-sumi-900"
    >
      <option
        v-for="option in options"
        :key="option.id"
        :value="option.id"
        :disabled="option.disabled"
      >
        {{ option.name }}
      </option>
    </select>
    <FormErrorMessage class="mt-1" field-name="genreId" :errors />
  </FormLayout>
</template>
