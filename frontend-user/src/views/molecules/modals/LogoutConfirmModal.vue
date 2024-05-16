<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue';
import LogoutButton from '@/views/molecules/buttons/LogoutButton.vue'
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
      <LogoutButton @click="emits('doLogout')" />
      <CancelButton @click="emits('cancel')" />
    </ModalFooter>
  </BaseModal>
</template>
