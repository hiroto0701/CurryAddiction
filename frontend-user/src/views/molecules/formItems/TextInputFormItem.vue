<script setup lang="ts">
import { type Component } from 'vue';
import FormLayout from '@/views/templates/FormLayout.vue'

interface Props {
  readonly label: string;
  readonly placeholder?: string;
  readonly required: boolean;
  readonly optional: boolean;
  readonly iconComponent: Component;
}
defineProps<Props>();

const model = defineModel<string>();
</script>
<template>
  <FormLayout :label :required :optional :iconComponent>
    <input type="text" class="mt-3 p-2 rounded w-full border border-gray-200 font-body text-sumi-900" :placeholder v-model="model">
  </FormLayout>
</template>