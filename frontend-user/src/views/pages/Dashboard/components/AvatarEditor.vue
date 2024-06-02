<script setup lang="ts">
import { useCommonStore } from '@/stores/common'
import CancelButton from '@/views/molecules/buttons/CancelButton.vue'
import UpdateButton from '@/views/molecules/buttons/UpdateButton.vue'

interface Props {
  readonly preview?: string
}
defineProps<Props>()

const commonStore = useCommonStore()

const emits = defineEmits<{
  (e: 'update'): void
  (e: 'cancel'): void
}>()
</script>
<template>
  <div class="flex items-center gap-2">
    <UpdateButton
      class="inline-flex items-center justify-center border text-sm py-3 px-4"
      :is-loading="commonStore.state.uploading"
      @click="emits('update')"
    />
    <CancelButton
      class="inline-flex items-center justify-center border text-sm py-3 px-4"
      @click="emits('cancel')"
    />
  </div>
</template>
