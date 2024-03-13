<script setup lang="ts">
import { type Component } from 'vue';
import FormLayout from '@/views/templates/FormLayout.vue'

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly optional: boolean;
  readonly iconComponent: Component;
}

defineProps<Props>();
</script>
<template>
  <FormLayout :label="label" :required="required" :optional="optional" :iconComponent="iconComponent">
    <input type="text" class="mt-3 p-2 rounded w-full border border-gray-200 font-body text-sumi-900" placeholder="お店の名前">
  </FormLayout>
</template>