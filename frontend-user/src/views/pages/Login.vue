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
const open = ref<boolean>(false)
const mailOpen = ref<boolean>(false)
const tokenOpen = ref<boolean>(false)

function openModal(): void {
  open.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  open.value = false
  document.body.style.overflow = 'auto'
}

function openMailModal(): void {
  open.value = false
  mailOpen.value = true
  document.body.style.overflow = 'hidden'
}

function closeMailModal(): void {
  mailOpen.value = false
  // email.value = ''
  accountStore.resetErrors
  document.body.style.overflow = 'auto'
}

function openTokenModal(): void {
  mailOpen.value = false
  tokenOpen.value = true
  document.body.style.overflow = 'hidden'
}

function closeTokenModal(): void {
  tokenOpen.value = false
  document.body.style.overflow = 'auto'
}

async function generateToken(): Promise<void> {
  if (accountStore.emailValidate(email.value)) {
    commonStore.startApiLoading()
    try {
      await accountStore.generateToken({ email: email.value })
      .then(() => {
        closeMailModal()
        openTokenModal()
      })
    } finally {
      commonStore.stopApiLoading()
    }
  }
}

async function userLogin(): Promise<void> {
  if (accountStore.tokenValidate(token.value)) {
    commonStore.startApiLoading()
    try {
      await accountStore.login({ email: email.value, token: token.value })
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
      <LoginButton text="ログイン" @click="openModal" />
      <form @submit.prevent="userLogin" class="w-1/2 px-10 gap-4 flex flex-col border-r border-sumi-300" novalidate>
        <!-- ログイン -->
        <Teleport to="body">
          <LoginModal
            v-show="open" 
            @start-login="openMailModal"
            :closeModal
          />
        </Teleport>

        <!-- メール -->
        <Teleport to="body">
          <EmailRegisterModal
            v-show="mailOpen"
            v-model="email"
            @send-email="generateToken"
            :closeModal="closeMailModal"
          />
        </Teleport>

        <!-- トークン -->
        <Teleport to="body">
          <TokenSubmitModal
            v-show="tokenOpen"
            v-model="token" 
            @do-login="userLogin"
            :closeModal="closeTokenModal"
          />
        </Teleport>
      </form>
    </div>
  </div>
</template>
