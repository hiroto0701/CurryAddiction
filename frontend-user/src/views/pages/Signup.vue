<script setup lang="ts">
import FloatingLabelTextInputFormItem from '@/views/molecules/formItems/FloatingLabelTextInputFormItem.vue'
import FloatingLabelPasswordInputFormItem from '@/views/molecules/formItems/FloatingLabelPasswordInputFormItem.vue'
import SignupButton from '@/views/molecules/buttons/SignupButton.vue'
import GotoLoginPageButton from '@/views/molecules/buttons/GotoLoginPageButton.vue'

</script>
<template>
  <div class="flex flex-col items-center w-1/2 mx-auto p-10 bg-sumi-100 rounded-xl">
    <h1 class="font-body text-sumi-900 font-bold text-xl">新規会員登録</h1>
    <div class="w-full mt-5">
      <form class="px-5 gap-4 flex flex-col items-center">
        <FloatingLabelTextInputFormItem label="メールアドレス" type="email" />
        <FloatingLabelPasswordInputFormItem label="パスワード" type="password" />
        <SignupButton text="登録" />
      </form>
    </div>
  </div>
  <div class="flex flex-col items-center mt-10">
    <h1 class="font-body text-sumi-900 font-bold text-xl">すでに会員の方</h1>
    <GotoLoginPageButton text="ログイン" />
  </div>
</template>