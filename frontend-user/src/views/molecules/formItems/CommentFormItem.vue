<script setup lang="ts">
import type { Component } from 'vue';
import PostFormErrorMessage from '@/views/atoms/ErrorMessage/PostFormErrorMessage.vue';
import FormLayout from '@/views/templates/FormLayout.vue';

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly optional: boolean;
  readonly iconComponent: Component;
  readonly errors?: Record<string, string[]>;
}
defineProps<Props>();

const model = defineModel<string>();
</script>
<template>
  <FormLayout
    :label="label"
    :required="required"
    :optional="optional"
    :iconComponent="iconComponent"
  >
    <textarea
      class="h-24 w-full rounded border border-gray-200 p-2 font-body"
      :class="{
        'text-sumi-900': model && model.length <= 140,
        'text-red-400': model && model.length > 140,
        'border-red-400': model && model.length > 140,
        'bg-red-100': model && model.length > 140
      }"
      placeholder="味の特徴や感想を教えてください。"
      v-model="model"
    ></textarea>
    <div class="flex justify-between">
      <div>
        <PostFormErrorMessage field-name="comment" :errors="errors" />
      </div>
      <span
        class="flex justify-end"
        :class="{
          'text-sumi-500': !model || model.length <= 140,
          'text-red-400': model && model.length > 140
        }"
      >
        {{ model ? model.length : 0 }} / 140
      </span>
    </div>
  </FormLayout>
</template>
