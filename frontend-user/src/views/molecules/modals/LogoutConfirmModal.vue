<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import ModalAgreeButton from '@/views/molecules/buttons/ModalAgreeButton.vue'
import CancelButton from '@/views/molecules/buttons/CancelButton.vue'

interface Props {
  closeModal: () => void
}

const accountStore = useAccountStore()
const modalContent = ref<string>(`@${accountStore.state.handle_name}としてログインしています`)

defineProps<Props>()
const emits = defineEmits<{
  (e: 'doLogout'): void
  (e: 'cancel'): void
}>()
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody title="ログアウトしますか？" :content="modalContent" />
    <ModalFooter>
      <ModalAgreeButton @click="emits('doLogout')" text="ログアウト" />
      <CancelButton @click="emits('cancel')" />
    </ModalFooter>
  </BaseModal>
</template>
