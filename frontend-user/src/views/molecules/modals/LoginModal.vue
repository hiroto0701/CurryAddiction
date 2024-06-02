<script setup lang="ts">
import BaseModal from '@/views/atoms/modal/BaseModal.vue'
import ModalBody from '@/views/atoms/modal/ModalBody.vue'
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'

interface Props {
  closeModal: () => void
}

const modalContent =
  'カレーの魅力を発信し合える場所。自慢の一品を写真とともに投稿して、仲間を増やそう。新たな味覚の発見が待っている'

defineProps<Props>()
const emits = defineEmits<{
  (e: 'startLogin'): void
}>()
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody title="Curry Addiction" :content="modalContent" />
    <ModalFooter>
      <LoginButton text="ログイン" @click="emits('startLogin')" />
    </ModalFooter>
  </BaseModal>
</template>
