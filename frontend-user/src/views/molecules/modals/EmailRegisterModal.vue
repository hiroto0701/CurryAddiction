<script setup lang="ts">
import { computed } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useCommonStore } from '@/stores/common'
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import SubmitButton from '@/views/molecules/buttons/SubmitButton.vue'
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'

interface Props {
  closeModal: () => void
}
defineProps<Props>()

const accountStore = useAccountStore()
const commonStore = useCommonStore()

const modalContent = '入力されたメールアドレスにログイン用コードが送られます。'
const emailError = computed((): boolean => !!accountStore.state.errors?.email)

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
      <p v-show="accountStore.state.errors?.email" class="font-body text-xs text-red-400">
        {{ accountStore.state.errors?.email?.[0] }}
      </p>
      <SubmitButton
        :is-loading="commonStore.state.apiLoading"
        :disabled="commonStore.state.apiLoading"
        text="メールを送信する"
        @click="emits('sendEmail')"
      />
    </ModalFooter>
  </BaseModal>
</template>
