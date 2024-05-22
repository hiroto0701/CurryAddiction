<script setup lang="ts">
import { computed } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useCommonStore } from '@/stores/common'
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import SendEmailButton from '@/views/molecules/buttons/SendEmailButton.vue'
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'

interface Props {
  closeModal: () => void
}
defineProps<Props>()

const accountStore = useAccountStore()
const commonStore = useCommonStore()

const modalContent = '入力されたメールアドレスにログイン用コードが送られます。'
const emailError = computed(() => 'email' in accountStore.state.errors)

const email = defineModel<string>()
const emits = defineEmits<{
  (e: 'sendEmail'): void
}>()
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody title="" :content="modalContent" />
    <ModalFooter>
      <FloatingLabelTextInputFormItem
        label="メールアドレス"
        type="email"
        :is-error="emailError"
        v-model="email"
      />
      <p v-show="accountStore.state.errors.email" class="font-body text-xs text-red-400">
        {{ accountStore.state.errors?.email?.[0] }}
      </p>
      <SendEmailButton :is-loading="commonStore.state.apiLoading" @click="emits('sendEmail')" />
    </ModalFooter>
  </BaseModal>
</template>
