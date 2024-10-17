<script setup lang="ts">
import { ref } from 'vue';
import UnAuthenticatedHeader from '@/views/organisms/UnAuthenticatedHeader.vue';
import UnAuthenticatedFooter from '@/views/organisms/UnAuthenticatedFooter.vue';

const email = ref<string>('');
const token = ref<string>('');
const modalState = ref<'login' | 'email' | 'token' | null>(null);

function openModal(modalName: 'login' | 'email' | 'token'): void {
  modalState.value = modalName;
  if (modalState.value === 'login') {
    email.value = '';
    token.value = '';
  }
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  modalState.value = null;
  document.body.style.overflow = 'auto';
}
</script>
<template>
  <div class="flex h-screen flex-col">
    <UnAuthenticatedHeader />
    <main class="xs:px-7 mx-auto w-full max-w-screen-md px-6 py-20 sm:px-10">
      <RouterView
        :open-modal
        :close-modal
        :modal-state
        v-model:email="email"
        v-model:token="token"
      />
    </main>
    <UnAuthenticatedFooter @open-modal="openModal('login')" />
  </div>
</template>
