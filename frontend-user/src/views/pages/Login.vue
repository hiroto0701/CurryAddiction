<script setup lang="ts">
import { ref } from 'vue'
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'
import FloatingLabelPasswordInputFormItem from '@/views/molecules/formItems/FloatingLabelPasswordInputFormItem.vue'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'

const email = ref<string>('')
const password = ref<string>('')
</script>
<template>
  <div class="flex flex-col items-center w-full p-10 bg-sumi-100 rounded-xl">
    <h1 class="font-body text-sumi-900 font-bold text-xl">ログイン</h1>
    <div class="w-full flex justify-between mt-5">
      <form class="w-1/2 px-10 gap-4 flex flex-col border-r border-sumi-300">
        <FloatingLabelTextInputFormItem label="メールアドレス" type="email" v-model="email" />
        <FloatingLabelPasswordInputFormItem label="パスワード" type="password" v-model="password" />
        <LoginButton text="ログイン" />
      </form>
      <form class="w-1/2 px-10 flex flex-col items-center">
        <span class="font-body text-sumi-900">または</span>
        <LoginButton text="ゲストとしてログイン" />
      </form>
    </div>
  </div>
  <div>
    <h1 class="font-body text-sumi-900 font-bold text-xl">初めてご利用の方</h1>
  </div>
</template>