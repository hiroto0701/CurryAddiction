<script setup lang="ts">
import BaseModal from '@/views/atoms/modal/BaseModal.vue';
import ModalBody from '@/views/atoms/modal/ModalBody.vue';
import ModalFooter from '@/views/atoms/modal/ModalFooter.vue';
import DeleteButton from '@/views/molecules/buttons/DeleteButton.vue';
import CancelButton from '@/views/molecules/buttons/CancelButton.vue';

interface Props {
  readonly closeModal: () => void;
  readonly isLoading: boolean;
  readonly modalTitle: string;
  readonly modalContent: string;
  readonly buttonText: string;
}
defineProps<Props>();

const emits = defineEmits<{
  (e: 'delete'): void;
  (e: 'cancel'): void;
}>();
</script>
<template>
  <BaseModal :closeModal>
    <ModalBody :title="modalTitle" :content="modalContent" />
    <ModalFooter>
      <DeleteButton @click="emits('delete')" :is-loading :text="buttonText" />
      <CancelButton @click="emits('cancel')" />
    </ModalFooter>
  </BaseModal>
</template>
