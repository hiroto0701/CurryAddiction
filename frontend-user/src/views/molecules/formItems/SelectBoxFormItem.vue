<script setup lang="ts">
import type { Component } from 'vue';
import PostFormErrorMessage from '@/views/atoms/ErrorMessage/PostFormErrorMessage.vue';
import FormLayout from '@/views/templates/FormLayout.vue';

interface Genre {
  id: number;
  name: string;
}

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly optional: boolean;
  readonly iconComponent: Component;
  readonly errors?: Record<string, string[]>;
  readonly options: Genre[];
}

defineProps<Props>();

const selected = defineModel<number | undefined>();
</script>
<template>
  <FormLayout
    :label="label"
    :required="required"
    :optional="optional"
    :iconComponent="iconComponent"
  >
    <select
      v-model="selected"
      name="genre"
      class="block w-60 rounded-md border border-gray-200 p-2 font-body text-sm text-sumi-900"
    >
      <option value="" hidden>選択してください</option>
      <option v-for="option in options" :key="option.id" :value="option.id">
        {{ option.name }}
      </option>
    </select>
    <PostFormErrorMessage field-name="genre_id" :errors="errors" />
  </FormLayout>
</template>
