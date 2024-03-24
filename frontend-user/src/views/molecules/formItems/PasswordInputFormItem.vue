<script setup lang="ts">
import { ref } from 'vue'
import FloatingInputFormItem from '@/views/molecules/formItems/FloatingInputFormItem.vue'
import PasswordHiddenIcon from '@/views/atoms/icons/PasswordHiddenIcon.vue'
import PasswordVisibleIcon from '@/views/atoms/icons/PasswordVisibleIcon.vue'

interface Props {
  label: string
  type: string
}

const props = defineProps<Props>();
const value = ref<string>('');
const isPasswordVisible = ref<boolean>(true);

const togglePasswordVisibility = (): void => {
  isPasswordVisible.value = !isPasswordVisible.value;
}
</script>

<template>
  <FloatingInputFormItem :label="props.label" :type="isPasswordVisible ? 'password' : 'text'" v-model="value">
    <PasswordVisibleIcon
      v-show="isPasswordVisible"
      class="absolute top-5 right-5 text-sumi-400"
      @click="togglePasswordVisibility"
    />
    <PasswordHiddenIcon
      v-show="!isPasswordVisible"
      class="absolute top-5 right-5 text-sumi-400"
      @click="togglePasswordVisibility"
    />
  </FloatingInputFormItem>
</template>