<script setup lang="ts">
import { ref } from 'vue'
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue'

interface Props {
  label: string
  type: string
}
defineProps<Props>();

const value = defineModel<string>()
const isFocused = ref<boolean>(false)
</script>
<template>
  <div class="relative w-full">
    <label
      :for="type"
      class="absolute font-body text-sumi-400 pl-3 font-semibold transition-all duration-300"
      :class="{
        'text-mini top-1': isFocused || value,
        'text-sm top-5': !isFocused && !value,
      }"
    >
      {{ label }}
    </label>
    <input
      :type="type"
      :id="type"
      v-model="value"
      @focus="isFocused = true"
      @blur="isFocused = false"
      class="w-full font-body text-sumi-900 px-3 pt-4 h-14 rounded-lg transition-all duration-300 border-2 border-red-400"
    />
    <ErrorIcon class="absolute top-5 right-3" />
    <slot :value />
  </div>
</template>
