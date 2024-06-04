<script setup lang="ts">
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import ModalAgreeButton from '@/views/molecules/buttons/ModalAgreeButton.vue'
import CancelButton from '@/views/molecules/buttons/CancelButton.vue'

interface Props {
  closeModal: () => void
}

// const accountStore = useAccountStore()

defineProps<Props>()
const emits = defineEmits<{
  (e: 'commit'): void
  (e: 'cancel'): void
}>()
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody title="この内容で投稿しますか？" />
    <ModalFooter>
      <ModalAgreeButton @click="emits('commit')" text="投稿する" />
      <CancelButton @click="emits('cancel')" />
    </ModalFooter>
  </BaseModal>
</template>
