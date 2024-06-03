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
    <select
      name="genre"
      class="block w-60 p-2 text-sm border rounded-md border-gray-200 font-body text-sumi-900"
    >
      <option value="" hidden>選択してください</option>
      <option value="">キーマカレー</option>
      <option value="">スリランカカレー</option>
      <option value="">インドカレー</option>
      <option value="">マトン系</option>
    </select>
  </FormLayout>
</template>
