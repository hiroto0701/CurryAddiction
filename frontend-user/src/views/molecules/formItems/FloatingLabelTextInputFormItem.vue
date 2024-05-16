<script setup lang="ts">
import FloatingLabelFormItem from '@/views/molecules/formItems/FloatingLabelFormItem.vue'

interface Props {
  label: string
  type: string
  isError: boolean
}
defineProps<Props>()

const value = defineModel<string>()
</script>
<template>
  <FloatingLabelFormItem :label :type :is-error v-model="value" />
</template>
