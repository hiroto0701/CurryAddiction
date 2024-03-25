<script setup lang="ts">
import FloatingLabelFormItem from '@/views/molecules/formItems/FloatingLabelFormItem.vue'

interface Props {
  label: string
  type: string
}
defineProps<Props>();

const email = defineModel<string>('email');
</script>
<template>
  <FloatingLabelFormItem :label :type v-model="email"  />
</template>