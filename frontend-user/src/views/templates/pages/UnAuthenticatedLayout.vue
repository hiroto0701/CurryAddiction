<script setup lang="ts">
import { RouterView } from 'vue-router';
import { useAuthModalStore } from '@/stores/auth_modal';
import LoginModal from '@/views/molecules/modals/LoginModal.vue';
import EmailRegisterModal from '@/views/molecules/modals/EmailRegisterModal.vue';
import TokenSubmitModal from '@/views/molecules/modals/TokenSubmitModal.vue';
import UnAuthenticatedHeader from '@/views/organisms/UnAuthenticatedHeader.vue';
import UnAuthenticatedFooter from '@/views/organisms/UnAuthenticatedFooter.vue';

const authModalStore = useAuthModalStore();
</script>

<template>
  <div class="flex h-screen flex-col">
    <UnAuthenticatedHeader />
    <main class="xs:px-7 mx-auto w-full max-w-screen-md px-6 py-20 sm:px-10">
      <RouterView @open-modal="authModalStore.openAuthModal('login')" />
    </main>

    <form
      @submit.prevent="authModalStore.login"
      class="flex w-1/2 flex-col gap-4 border-r border-sumi-300 px-10"
      novalidate
    >
      <Teleport to="body">
        <LoginModal
          v-show="authModalStore.state.modalState === 'login'"
          @start-login="authModalStore.openAuthModal('email')"
          :closeAuthModal="authModalStore.closeAuthModal"
        />
        <EmailRegisterModal
          v-show="authModalStore.state.modalState === 'email'"
          v-model="authModalStore.state.email"
          @send-email="authModalStore.generateToken"
          :closeAuthModal="authModalStore.closeAuthModal"
        />
        <TokenSubmitModal
          v-show="authModalStore.state.modalState === 'token'"
          v-model="authModalStore.state.token"
          :email="authModalStore.state.email"
          @do-login="authModalStore.login"
          :closeAuthModal="authModalStore.closeAuthModal"
        />
      </Teleport>
    </form>
    <UnAuthenticatedFooter @open-modal="authModalStore.openAuthModal('login')" />
  </div>
</template>
