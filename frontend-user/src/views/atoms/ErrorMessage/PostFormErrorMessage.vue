<script setup lang="ts">
import { usePostFormStore } from '@/stores/post_form'

interface Props {
  readonly fieldName: string
}
defineProps<Props>()

const postFormStore = usePostFormStore()
</script>
<template>
  <div>
    <p v-show="postFormStore.state.errors[fieldName]" class="font-body mt-1 text-xs text-red-400">
      {{ postFormStore.state.errors[fieldName]?.[0] }}
    </p>
  </div>
</template>
