<script setup lang="ts">
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue';
import Toast from '@/views/atoms/Toast.vue';
import ToastBody from '@/views/atoms/ToastBody.vue';

interface Props {
  readonly message: null | string;
}
defineProps<Props>();
</script>

<template>
  <Toast class="bg-red-500">
    <ToastBody :message :icon-component="ErrorIcon" />
  </Toast>
</template>
