<script setup lang="ts">
import { ref } from 'vue'
import FloatingLabelFormItem from '@/views/molecules/formItems/FloatingLabelFormItem.vue'
import PasswordHiddenIcon from '@/views/atoms/icons/PasswordHiddenIcon.vue'
import PasswordVisibleIcon from '@/views/atoms/icons/PasswordVisibleIcon.vue'

interface Props {
  label: string
  type: string
}
defineProps<Props>();

const isPasswordVisible = ref<boolean>(false);
const password = ref<string>('');

const togglePasswordVisibility = (): void => {
  isPasswordVisible.value = !isPasswordVisible.value;
}
</script>
<template>
  <FloatingLabelFormItem :label :type="isPasswordVisible ? 'text' : 'password'" v-model="password">
    <template v-slot:default="{ value }">
      <div v-if="value">
        <PasswordHiddenIcon
          v-show="!isPasswordVisible"
          class="absolute top-5 right-5 text-sumi-400"
          @click="togglePasswordVisibility"
        />
        <PasswordVisibleIcon
          v-show="isPasswordVisible"
          class="absolute top-5 right-5 text-sumi-400"
          @click="togglePasswordVisibility"
        />
      </div>
    </template>
  </FloatingLabelFormItem>
</template>