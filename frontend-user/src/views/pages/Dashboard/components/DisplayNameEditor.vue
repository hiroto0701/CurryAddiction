<script setup lang="ts">
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue'
import UpdateButton from '@/views/molecules/buttons/UpdateButton.vue'
import CancelButton from '@/views/molecules/buttons/CancelButton.vue'

interface Props {
  displayName: null | string
  readonly isError: boolean
}
defineProps<Props>()

const model = defineModel<string | null>()

const emits = defineEmits<{
  (e: 'update'): void
  (e: 'cancel'): void
}>()
</script>
<template>
  <div class="relative">
    <input 
      type="text" 
      v-model="model"
      class="block w-full mt-3 text-sm border bg-red border-gray-300 p-3 rounded-lg"
      :class="{ 
        'border-2': isError,
        'bg-red-100': isError,
        'border-red-400': isError
      }"  
    >
    <ErrorIcon v-if="isError" class="absolute top-1/2 -translate-y-1/2 right-3" />
  </div>
  <span 
    class="flex justify-end"
    :class="{'text-sumi-500': model.length <= 20, 'text-red-400': model.length > 20}"
  >
    {{ model.length }} / 20
  </span>
  <UpdateButton 
    class="inline-flex items-center justify-center border text-sm py-3 px-4 mr-2"
    @click="emits('update')"
  />
  <CancelButton 
    class="inline-flex items-center justify-center border text-sm py-3 px-4" 
    @click="emits('cancel')"
  />
</template>
