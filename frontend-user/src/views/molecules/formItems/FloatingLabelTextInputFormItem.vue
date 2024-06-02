<script setup lang="ts">
import FloatingLabelFormItem from '@/views/molecules/formItems/FloatingLabelFormItem.vue'

interface Props {
  readonly label: string
  readonly type: string
  readonly isError: boolean
}
defineProps<Props>()

const value = defineModel<string>()
</script>
<template>
  <FloatingLabelFormItem :label :type :is-error v-model="value" />
</template>
