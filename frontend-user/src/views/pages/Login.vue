<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useAccountFormStore } from '@/stores/account_form'
import { useCommonStore } from '@/stores/common'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'
import LoginModal from '@/views/molecules/modals/LoginModal.vue'
import EmailRegisterModal from '@/views/molecules/modals/EmailRegisterModal.vue'
import TokenSubmitModal from '@/views/molecules/modals/TokenSubmitModal.vue'

const accountStore = useAccountStore()
const accountFormStore = useAccountFormStore()
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

async function generateToken(): Promise<boolean> {
  if (!accountStore.emailValidate(email.value)) return false

  accountFormStore.setEmail(email.value)
  commonStore.startApiLoading()
  const response: boolean = await accountStore.generateToken({ email: email.value })
  commonStore.stopApiLoading()

  if (response) {
    closeModal()
    openModal('token')
    return true
  }

  return false
}

async function userLogin(): Promise<boolean> {
  if (!accountStore.tokenValidate(token.value)) return false

  accountFormStore.setToken(token.value)
  commonStore.startApiLoading()
  const loginSuccess: boolean = await accountStore.login({ email: email.value, token: token.value })
  commonStore.stopApiLoading()

  if (loginSuccess) {
    closeModal()
    return true
  }

  return false
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
            v-show="modalState === 'login'"
            @start-login="openModal('email')"
            :closeModal="closeModal"
          />
        </Teleport>
        <Teleport to="body">
          <EmailRegisterModal
            v-show="modalState === 'email'"
            v-model="email"
            @send-email="generateToken"
            :closeModal="closeModal"
          />
        </Teleport>
        <Teleport to="body">
          <TokenSubmitModal
            v-show="modalState === 'token'"
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
