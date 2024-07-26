<script setup lang="ts">
import type { Component } from 'vue'
import PostFormErrorMessage from '@/views/atoms/ErrorMessage/PostFormErrorMessage.vue'
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue'
import FormLayout from '@/views/templates/FormLayout.vue'

interface Props {
  readonly label: string
  readonly placeholder?: string
  readonly required: boolean
  readonly optional: boolean
  readonly isError: boolean
  readonly iconComponent: Component
}
defineProps<Props>()

const model = defineModel<string>()
</script>
<template>
  <FormLayout :label :required :optional :iconComponent>
    <div class="relative">
      <input
        type="text"
        class="w-full rounded border border-gray-200 p-2 pr-9 font-body"
        :class="{
          'text-sumi-900': !isError,
          'text-red-400': isError,
          'border-red-400': isError,
          'bg-red-100': isError
        }"
        :placeholder
        v-model="model"
      />
      <ErrorIcon v-show="isError" class="absolute right-3 top-1/2 -translate-y-1/2" />
    </div>
    <div class="flex justify-between">
      <div>
        <PostFormErrorMessage field-name="store_name" />
      </div>
      <span
        class="flex justify-end"
        :class="{
          'text-sumi-500': !isError,
          'text-red-400': isError
        }"
      >
        {{ model ? model.length : 0 }} / 30
      </span>
    </div>
  </FormLayout>
</template>
