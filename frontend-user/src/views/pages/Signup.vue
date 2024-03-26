<script setup lang="ts">
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'
import FloatingLabelPasswordInputFormItem from '@/views/molecules/formItems/FloatingLabelPasswordInputFormItem.vue'
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'
import GotoLoginPageButton from '@/views/molecules/buttons/GotoLoginPageButton.vue'

</script>
<template>
  <div class="flex flex-col items-center w-full p-10 bg-sumi-100 rounded-xl">
    <h1 class="font-body text-sumi-900 font-bold text-xl">新規会員登録</h1>
    <div class="w-full flex justify-between mt-5">
      <form class="w-1/2 px-10 gap-4 flex flex-col border-r border-sumi-300">
        <FloatingLabelTextInputFormItem label="メールアドレス" type="email" />
        <FloatingLabelPasswordInputFormItem label="パスワード" type="password" />
        <LoginButton text="ログイン" />
      </form>
      <form class="w-1/2 px-10 flex flex-col items-center">
        <span class="font-body text-sumi-900">または</span>
        <LoginButton text="ゲストとしてログイン" />
      </form>
    </div>
  </div>
  <div class="flex flex-col items-center mt-10">
    <h1 class="font-body text-sumi-900 font-bold text-xl">すでに会員の方</h1>
    <GotoLoginPageButton text="ログイン" />
  </div>
</template>