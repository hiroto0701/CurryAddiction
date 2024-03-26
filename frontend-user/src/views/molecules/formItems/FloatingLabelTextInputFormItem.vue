<script setup lang="ts">
import { ref } from 'vue'
import FloatingLabelFormItem from '@/views/molecules/formItems/FloatingLabelFormItem.vue'

interface Props {
  label: string
  type: string
}
defineProps<Props>();

const email = ref<string>('')
</script>
<template>
  <FloatingLabelFormItem :label :type v-model="email" />
</template>