<script setup lang="ts">
import ModalTitle from '@/views/atoms/modal/ModalTitle.vue'
import ModalContent from '@/views/atoms/modal/ModalContent.vue'

interface Props {
  readonly title: string
  readonly content: string | null
}

defineProps<Props>()

</script>
<template>
  <div class="flex flex-col gap-4">
    <ModalTitle :title />
    <ModalContent :content />
  </div>
</template>
