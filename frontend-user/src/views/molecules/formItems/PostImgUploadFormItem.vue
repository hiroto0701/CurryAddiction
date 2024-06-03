<script setup lang="ts">
import { type Component } from 'vue'
import FormLayout from '@/views/templates/FormLayout.vue'

interface Props {
  readonly label: string
  readonly required: boolean
  readonly optional: boolean
  readonly iconComponent: Component
}

defineProps<Props>()
</script>
<template>
  <FormLayout
    :label="label"
    :required="required"
    :optional="optional"
    :iconComponent="iconComponent"
  >
    <label
      for="post_img"
      class="p-2 cursor-pointer text-sm rounded-md flex items-center w-fit gap-2 border border-gray-200 hover:bg-slate-100 font-body text-sumi-900"
    >
      <component :is="iconComponent" class="text-sumi-900" />
      画像を選択
    </label>
    <input type="file" class="hidden" id="post_img" />
  </FormLayout>
</template>
