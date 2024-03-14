<script setup lang="ts">
import { type Component } from 'vue';
import FormLayout from '@/views/templates/FormLayout.vue'
import { ref } from 'vue'

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly optional: boolean;
  readonly iconComponent: Component;
}

defineProps<Props>();

const textValue = ref<string>('');
</script>
<template>
  <FormLayout :label="label" :required="required" :optional="optional" :iconComponent="iconComponent">
    <textarea 
      class="mt-3 p-2 w-full h-24 border border-gray-200 rounded font-body text-sumi-900" 
      placeholder="味の特徴や感想を教えてください。"
      v-model="textValue"
    ></textarea>
    <span 
      class="flex justify-end"
      :class="{'text-sumi-500': textValue.length <= 140, 'text-red-500': textValue.length > 140}"
    >
      {{ textValue.length }} / 140
    </span>
  </FormLayout>
</template>