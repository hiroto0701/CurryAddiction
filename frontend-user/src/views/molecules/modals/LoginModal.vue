<script setup lang="ts">
import BaseModal from '@/views/atoms/modal/BaseModal.vue';
import ModalBody from '@/views/atoms/modal/ModalBody.vue';
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue';
import LoginButton from '@/views/molecules/buttons/LoginButton.vue';

interface Props {
  closeAuthModal: () => void;
}
defineProps<Props>();

const modalContent = 'カレーの魅力を発信し、お気に入りの一品に出会うきっかけとなるサービス';

const emits = defineEmits<{
  (e: 'startLogin'): void;
}>();
</script>

<template>
  <BaseModal :close-modal="closeAuthModal">
    <ModalBody title="Curry Addiction" :content="modalContent" />
    <ModalFooter>
      <LoginButton text="ログイン" @click="emits('startLogin')" />
    </ModalFooter>
  </BaseModal>
</template>
