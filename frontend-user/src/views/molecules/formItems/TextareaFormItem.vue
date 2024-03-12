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
    <textarea class="block text-sm mt-3 p-1 w-full h-24 border border-gray-200 rounded" placeholder="味の特徴や感想を教えてください。"></textarea>
  </FormLayout>
</template>