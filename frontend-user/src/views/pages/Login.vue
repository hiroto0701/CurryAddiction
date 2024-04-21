<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { useAccountStore } from '@/stores/account'
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'
import FloatingLabelPasswordInputFormItem from '@/views/molecules/formItems/FloatingLabelPasswordInputFormItem.vue'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'
import GotoSignupPageButton from '@/views/molecules/buttons/GotoSignupPageButton.vue'

const accountStore = useAccountStore();

const email = ref<string>('')
const password = ref<string>('')
const errors = ref<Record<string, string[]>>({})

const isValid = (): boolean => {
  // errorがなければtrueを返す
  return !accountStore.state.errors ? true : false;
}

const validate = (): boolean => {
  errors.value = {}

  if (!email.value) {
    errors.value.email = ['メールアドレスを入力してください']
  }

  if (!password.value) {
    errors.value.password = ['パスワードを入力してください']
  }

  if (Object.keys(errors.value).length > 0) {
    accountStore.setErrors(errors.value);
    return false;
  }

  accountStore.resetErrors()
  return true;
}

const userLogin = (): void => {
  if (validate()) {
    accountStore.login({ email: email.value, password: password.value })
  }
}

onMounted(() => {
  console.log(isValid());
})
</script>
<template>
  <div class="flex flex-col items-center w-full p-10 bg-sumi-100 rounded-xl">
    <h1 class="font-body text-sumi-900 font-bold text-xl">ログイン</h1>
    <div class="w-full flex justify-between mt-5">
      <form @submit.prevent="userLogin" class="w-1/2 px-10 gap-4 flex flex-col border-r border-sumi-300">
        <FloatingLabelTextInputFormItem label="メールアドレス" type="email" v-model="email" />
        <p v-show="accountStore.state.errors.email" class="font-body text-xs text-red-400">{{ accountStore.state.errors?.email?.[0] }}</p>
        <FloatingLabelPasswordInputFormItem label="パスワード" type="password"  v-model="password" />
        <p v-if="accountStore.state.errors.password" class="font-body text-xs text-red-400">{{ accountStore.state.errors?.password?.[0] }}</p>
        <p v-if="accountStore.state.errors.auth" class="font-body text-xs text-red-400">{{ accountStore.state.errors?.auth?.[0] }}</p>
        <LoginButton text="ログイン" />
      </form>
      <form class="w-1/2 px-10 flex flex-col items-center">
        <span class="font-body text-sumi-900">または</span>
        <LoginButton text="ゲストとしてログイン" />
      </form>
    </div>
  </div>
  <div class="flex flex-col items-center mt-10">
    <h1 class="font-body text-sumi-900 font-bold text-xl">初めてご利用の方</h1>
    <GotoSignupPageButton text="新規会員登録" />
  </div>
</template>
