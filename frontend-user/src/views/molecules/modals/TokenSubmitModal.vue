<script setup lang="ts">
import { ref } from 'vue'
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'
import TokenCommitButton from '@/views/molecules/buttons/TokenCommitButton.vue'

interface Props {
  closeModal: () => void
}
const token = defineModel<string>()
const modalContent = ref<string>(`5分以内に test@mail.com に届いたコードを入力してください。`)

defineProps<Props>()
const emits = defineEmits<{
  (e: 'doLogin'): void
}>()
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody title="確認コードを送りました" :content="modalContent" />
    <ModalFooter>
      <FloatingLabelTextInputFormItem
        label="確認コード"
        type="text"
        :is-error="false"
        v-model="token"
      />
      <TokenCommitButton @click="emits('doLogin')" />
    </ModalFooter>
  </BaseModal>
</template>
