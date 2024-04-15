<script setup lang="ts">
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'
import FloatingLabelPasswordInputFormItem from '@/views/molecules/formItems/FloatingLabelPasswordInputFormItem.vue'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'
import GotoSignupPageButton from '@/views/molecules/buttons/GotoSignupPageButton.vue'
import { ref } from 'vue'
import axios from 'axios'

const email = ref('')
const password = ref('')
const error = ref('')

const handleLogin = async () => {
  axios.get('/sanctum/csrf-cookie').then(response => {
    axios.post('/api/login', {
      email: email.value,
      password: password.value
    })
    .then(response => {
      // ログイン成功時の処理
      localStorage.setItem('token', response.data.token)
      window.location.href = '/dashboard'
    })
    .catch(error => {
      // ログイン失敗時の処理
      error.value = error.response.data.message
      console.log(error);
    })
  })
}

</script>
<template>
  <div class="flex flex-col items-center w-full p-10 bg-sumi-100 rounded-xl">
    <h1 class="font-body text-sumi-900 font-bold text-xl">ログイン</h1>
    <div class="w-full flex justify-between mt-5">
      <form @submit.prevent="handleLogin" class="w-1/2 px-10 gap-4 flex flex-col border-r border-sumi-300">
        <FloatingLabelTextInputFormItem label="メールアドレス" type="email" v-model="email" />
        <FloatingLabelPasswordInputFormItem label="パスワード" type="password" v-model="password" />
        <LoginButton text="ログイン" @click="handleLogin"  />
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