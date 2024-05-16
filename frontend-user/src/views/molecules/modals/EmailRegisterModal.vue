<script setup lang="ts">
import { ref, computed } from 'vue'
import { useAccountStore } from '@/stores/account'
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import SendEmailButton from '@/views/molecules/buttons/SendEmailButton.vue'
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'

interface Props {
  closeModal: () => void
}

const accountStore = useAccountStore()
const modalContent = ref<string>(`入力されたメールアドレスにログイン用リンクが送られます。`)

const emailError = computed(() => 'email' in accountStore.state.errors)

const email = defineModel<string>()

defineProps<Props>()
const emits = defineEmits<{
  (e: 'doLogin'): void
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
      <SendEmailButton @click="emits('doLogin')" />
    </ModalFooter>
  </BaseModal>
</template>
