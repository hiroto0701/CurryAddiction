<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAccountStore } from '@/stores/account'
import { useAccountFormStore } from '@/stores/account_form'
import { useCommonStore } from '@/stores/common'
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'
import AccountAbortConfirmModal from '@/views/molecules/modals/AccountAbortConfirmModal.vue'
import HandleNameFormItem from '@/views/molecules/formItems/HandleNameFormItem.vue'

const router = useRouter()
const accountStore = useAccountStore()
const accountFormStore = useAccountFormStore()
const commonStore = useCommonStore()

const open = ref<boolean>(false)
const handleName = ref<string>('')

const handleNameError = computed((): boolean => 'handle_name' in accountFormStore.state.errors)
const handleNameLengthError = computed((): boolean => {
  return handleName.value.length < 2 || handleName.value.length > 20;
})

function openModal(): void {
  open.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  open.value = false
  document.body.style.overflow = 'auto'
}

function accountAbort(): void {
  accountStore.resetData()
  accountFormStore.resetData()
  router.push({ name: 'Login' })
}

async function doLogin(): Promise<void> {
  if (accountFormStore.handleNameValidate(handleName.value)) {
    commonStore.startApiLoading()
    try {
      const loginSuccess: boolean = await accountFormStore.registerAndLogin(handleName.value)
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
  <h1 class="font-body text-sumi-900 w-fit mx-auto text-2xl">アカウントを作成します</h1>
  <div class="flex flex-col items-center mx-auto mt-5 p-10 bg-sumi-100 rounded-xl">
    <h2 class="font-body text-sumi-900 w-fit mx-auto text-lg">ハンドルネームを決めましょう</h2>
    <form class="px-5" @submit.prevent="doLogin">
      <div class="flex items-center mt-5">
        <div class="font-body text-sumi-900">curry-addiction/</div>
        <div class="relative">
          <HandleNameFormItem class="ml-1" v-model="handleName" :is-error="handleNameError" />
          <ErrorIcon v-if="handleNameError" class="absolute top-1/2 -translate-y-1/2 right-3" />
        </div>
      </div>
      <span 
        class="flex justify-end" 
        :class="{
          'text-sumi-500': !handleNameLengthError, 
          'text-red-400': handleNameLengthError
        }"
      >
        {{ handleName ? handleName.length : 0 }} / 20
      </span>
      <p v-show="accountFormStore.state.errors.handle_name" class="font-body text-xs text-red-400 w-fit mx-auto">
        {{ accountFormStore.state.errors?.handle_name?.[0] }}
      </p>
      <div class="flex items-center">
        <LoginButton class="w-fit mt-5 mx-auto" :is-loading="commonStore.state.apiLoading" text="確定する" />
      </div>
    </form>
  </div>
  <button 
    class="block w-fit mx-auto mt-5 pb-1 font-body text-sumi-500 hover:text-sumi-900 duration-300 border-b-2 border-dotted border-sumi-300 hover:border-sumi-900"
    @click="openModal"
  >
    アカウント作成をやめる
  </button>

  <Teleport to="body">
    <AccountAbortConfirmModal 
      v-show="open"
      @abort="accountAbort"
      @cancel="closeModal" 
      :closeModal="closeModal"
    />
  </Teleport>
</template>
