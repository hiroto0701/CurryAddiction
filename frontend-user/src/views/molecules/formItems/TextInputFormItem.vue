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
    <input type="text" class="block text-sm mt-3 px-1 pt-2 w-full border-b border-gray-200" placeholder="お店の名前">
  </FormLayout>
</template>