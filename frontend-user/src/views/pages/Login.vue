<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useCommonStore } from '@/stores/common'
import LoginModal from '@/views/molecules/modals/LoginModal.vue'
import EmailRegisterModal from '@/views/molecules/modals/EmailRegisterModal.vue'
import TokenSubmitModal from '@/views/molecules/modals/TokenSubmitModal.vue'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'

const accountStore = useAccountStore()
const commonStore = useCommonStore()
const email = ref<string>('')
const token = ref<string>('')
const modalState = ref<'login' | 'email' | 'token' | null>(null)

function openModal(modalName: 'login' | 'email' | 'token'): void {
  modalState.value = modalName
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  modalState.value = null
  document.body.style.overflow = 'auto'
}

async function generateToken(): Promise<void> {
  if (accountStore.emailValidate(email.value)) {
    commonStore.startApiLoading()
    try {
      await accountStore.generateToken({ email: email.value })
      closeModal()
      openModal('token')
    } finally {
      commonStore.stopApiLoading()
    }
  }
}

async function userLogin(): Promise<void> {
  if (accountStore.tokenValidate(token.value)) {
    commonStore.startApiLoading()
    try {
      const loginSuccess = await accountStore.login({ email: email.value, token: token.value })
      if (loginSuccess) {
        closeModal()
      } 
    } finally {
      commonStore.stopApiLoading()
    }
  }
}
</script>
<template>
  <div class="flex flex-col items-center w-full p-10 bg-sumi-100 rounded-xl">
    <h1 class="font-body text-sumi-900 font-bold text-xl">ログイン</h1>
    <div class="w-full flex justify-between mt-5">
      <LoginButton text="ログイン" @click="openModal('login')" />
      <form @submit.prevent="userLogin" class="w-1/2 px-10 gap-4 flex flex-col border-r border-sumi-300" novalidate>
        <Teleport to="body">
          <LoginModal 
            v-if="modalState === 'login'"
            @start-login="openModal('email')"
            :closeModal="closeModal"
          />
        </Teleport>
        <Teleport to="body">
          <EmailRegisterModal
            v-if="modalState === 'email'"
            v-model="email"
            @send-email="generateToken"
            :closeModal="closeModal"
          />
        </Teleport>
        <Teleport to="body">
          <TokenSubmitModal
            v-if="modalState === 'token'"
            v-model="token"
            :email="email"
            @do-login="userLogin"
            :closeModal="closeModal"
          />
        </Teleport>
      </form>
    </div>
  </div>
</template>
