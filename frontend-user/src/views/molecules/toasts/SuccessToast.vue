<script setup lang="ts">
import CheckIcon from '@/views/atoms/icons/CheckIcon.vue'
import Toast from '@/views/atoms/Toast.vue'
import ToastBody from '@/views/atoms/ToastBody.vue'

interface Props {
  readonly message: null | string
}
defineProps<Props>()
</script>
<template>
  <Toast>
    <ToastBody :message :icon-component="CheckIcon" />
  </Toast>
</template>
