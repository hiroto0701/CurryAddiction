<script setup lang="ts">
import type { Component } from 'vue'
import PostFormErrorMessage from '@/views/atoms/ErrorMessage/PostFormErrorMessage.vue'
import FormLayout from '@/views/templates/FormLayout.vue'

interface Props {
  readonly label: string
  readonly required: boolean
  readonly optional: boolean
  readonly iconComponent: Component
  readonly errors?: Record<string, string[]>
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
      class="block w-60 rounded-md border border-gray-200 p-2 font-body text-sm text-sumi-900"
    >
      <option value="" hidden>選択してください</option>
      <option value="">キーマカレー</option>
      <option value="">スリランカカレー</option>
      <option value="">インドカレー</option>
      <option value="">マトン系</option>
    </select>
    <PostFormErrorMessage field-name="genre_id" :errors="errors" />
  </FormLayout>
</template>
