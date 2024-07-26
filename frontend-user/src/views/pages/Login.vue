<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useAccountFormStore } from '@/stores/account_form'
import { useCommonStore } from '@/stores/common'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'
import LoginModal from '@/views/molecules/modals/LoginModal.vue'
import EmailRegisterModal from '@/views/molecules/modals/EmailRegisterModal.vue'
import TokenSubmitModal from '@/views/molecules/modals/TokenSubmitModal.vue'
import UnAuthenticatedFooter from '@/views/organisms/UnAuthenticatedFooter.vue'

const accountStore = useAccountStore()
const accountFormStore = useAccountFormStore()
const commonStore = useCommonStore()
const email = ref<string>('')
const token = ref<string>('')
const modalState = ref<'login' | 'email' | 'token' | null>(null)

function openModal(modalName: 'login' | 'email' | 'token'): void {
  modalState.value = modalName

  // モーダルを開くたびに入力データをリセット
  if (modalState.value === 'login') {
    email.value = ''
    token.value = ''
  }
  accountStore.resetErrors()
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

async function login(): Promise<boolean> {
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
  <main class="xs:px-7 mx-auto my-12 flex h-auto w-full max-w-4xl flex-col px-6 sm:px-10">
    <div class="flex w-full flex-col items-center rounded-xl bg-sumi-100 p-10">
      <h1 class="font-body text-xl font-bold text-sumi-900">ログイン</h1>
      <div class="mt-5 flex w-full justify-between">
        <LoginButton text="ログイン" @click="openModal('login')" />
        <form
          @submit.prevent="login"
          class="flex w-1/2 flex-col gap-4 border-r border-sumi-300 px-10"
          novalidate
        >
          <Teleport to="body">
            <LoginModal
              v-show="modalState === 'login'"
              @start-login="openModal('email')"
              :closeModal="closeModal"
            />
            <EmailRegisterModal
              v-show="modalState === 'email'"
              v-model="email"
              @send-email="generateToken"
              :closeModal="closeModal"
            />
            <TokenSubmitModal
              v-show="modalState === 'token'"
              v-model="token"
              :email="email"
              @do-login="login"
              :closeModal="closeModal"
            />
          </Teleport>
        </form>
      </div>
    </div>
  </main>
  <UnAuthenticatedFooter @open-modal="openModal('login')" />
</template>
