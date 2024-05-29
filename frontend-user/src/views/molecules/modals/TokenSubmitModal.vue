<script setup lang="ts">
import { computed } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useCommonStore } from '@/stores/common'
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'
import TokenCommitButton from '@/views/molecules/buttons/TokenCommitButton.vue'

interface Props {
  closeModal: () => void
  email: string
}
const props = defineProps<Props>()

const accountStore = useAccountStore()
const commonStore = useCommonStore()

const modalContent = computed((): string => `5分以内に ${props.email} に届いたコードを入力してください。`)
const tokenError = computed((): boolean => !!accountStore.state.errors?.token)

const token = defineModel<string>()
const emits = defineEmits<{
  (e: 'doLogin'): void
}>()
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody title="認証コードを送りました" :content="modalContent" />
    <ModalFooter>
      <FloatingLabelTextInputFormItem
        label="認証コード"
        type="text"
        :is-error="tokenError"
        v-model="token"
      />
      <p v-show="accountStore.state.errors?.token" class="font-body text-xs text-red-400">
        {{ accountStore.state.errors?.token?.[0] }}
      </p>
      <TokenCommitButton :is-loading="commonStore.state.apiLoading" @click="emits('doLogin')" />
    </ModalFooter>
  </BaseModal>
</template>
