<script setup lang="ts">
import { useAccountStore } from '@/stores/account'
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import AccountAbortButton from '@/views/molecules/buttons/AccountAbortButton.vue'
import CancelButton from '@/views/molecules/buttons/CancelButton.vue'

interface Props {
  closeModal: () => void
}

const accountStore = useAccountStore()
const modalContent = 'アカウントを作成せずに終了します。よろしいですか？'

defineProps<Props>()
const emits = defineEmits<{
  (e: 'abort'): void
  (e: 'cancel'): void
}>()
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody title="アカウントの作成をやめますか？" :content="modalContent" />
    <ModalFooter>
      <AccountAbortButton @click="emits('abort')" />
      <CancelButton @click="emits('cancel')" />
    </ModalFooter>
  </BaseModal>
</template>
