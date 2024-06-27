<script setup lang="ts">
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import DeletePostButton from '@/views/molecules/buttons/DeletePostButton.vue'
import CancelButton from '@/views/molecules/buttons/CancelButton.vue'

interface Props {
  closeModal: () => void
}
defineProps<Props>()

const modalContent = 'ごみ箱の投稿は30日後に完全に削除されます。'
const emits = defineEmits<{
  (e: 'delete'): void
  (e: 'cancel'): void
}>()
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody title="ごみ箱に入れますか？" :content="modalContent" />
    <ModalFooter>
      <DeletePostButton @click="emits('delete')" />
      <CancelButton @click="emits('cancel')" />
    </ModalFooter>
  </BaseModal>
</template>
