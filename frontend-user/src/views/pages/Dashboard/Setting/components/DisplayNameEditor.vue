<script setup lang="ts">
import { useCommonStore } from '@/stores/common';
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue';
import UpdateButton from '@/views/molecules/buttons/UpdateButton.vue';
import CancelButton from '@/views/molecules/buttons/CancelButton.vue';
import DisplayNameFormItem from '@/views/molecules/formItems/DisplayNameFormItem.vue';

interface Props {
  readonly isError: boolean;
}
defineProps<Props>();

const commonStore = useCommonStore();

const model = defineModel<string>();

const emits = defineEmits<{
  (e: 'update'): void;
  (e: 'cancel'): void;
}>();
</script>

<template>
  <div class="relative">
    <DisplayNameFormItem v-model="model" :is-error />
    <ErrorIcon v-if="isError" class="absolute right-3 top-1/2 -translate-y-1/2" />
  </div>
  <span
    class="flex justify-end"
    :class="{
      'text-sumi-500': !isError,
      'text-red-400': isError
    }"
  >
    {{ model ? model.length : 0 }} / 20
  </span>

  <div class="flex items-center gap-2">
    <UpdateButton
      class="inline-flex items-center justify-center px-4 py-3 text-sm"
      :is-loading="commonStore.state.apiLoading"
      :disabled="commonStore.state.apiLoading"
      @click="emits('update')"
    />
    <CancelButton
      class="inline-flex items-center justify-center px-4 py-3 text-sm"
      @click="emits('cancel')"
    />
  </div>
</template>
