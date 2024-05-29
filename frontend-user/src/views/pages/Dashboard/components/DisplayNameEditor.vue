<script setup lang="ts">
import { useCommonStore } from '@/stores/common'
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue'
import UpdateButton from '@/views/molecules/buttons/UpdateButton.vue'
import CancelButton from '@/views/molecules/buttons/CancelButton.vue'
import DisplayNameFormItem from '@/views/molecules/formItems/DisplayNameFormItem.vue'

interface Props {
  readonly displayName: string
  readonly isError: boolean
}
defineProps<Props>()

const commonStore = useCommonStore()

const model = defineModel<string>()

const emits = defineEmits<{
  (e: 'update'): void
  (e: 'cancel'): void
}>()
</script>
<template>
  <div class="relative">
    <DisplayNameFormItem v-model="model" :is-error />
    <ErrorIcon v-if="isError" class="absolute top-1/2 -translate-y-1/2 right-3" />
  </div>
  <span 
    class="flex justify-end" 
    :class="{
      'text-sumi-500': model && model.length <= 20, 
      'text-red-400': !model || model.length > 20 || model.length === 0
    }"
  >
    {{ model ? model.length : 0 }} / 20
  </span>

  <div class="flex items-center gap-2">
    <UpdateButton 
      class="inline-flex items-center justify-center text-sm py-3 px-4"
      :is-loading="commonStore.state.apiLoading"
      @click="emits('update')"
    />
    <CancelButton 
      class="inline-flex items-center justify-center text-sm py-3 px-4" 
      @click="emits('cancel')"
    />
  </div>
</template>
