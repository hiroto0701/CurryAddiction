<script setup lang="ts">
import { ref } from 'vue'
import FloatingInputFormItem from '@/views/molecules/formItems/FloatingInputFormItem.vue'
import PasswordInputFormItem from '@/views/molecules/formItems/PasswordInputFormItem.vue'

const email = ref<string>('');
const password = ref<string>('');
</script>
<template>
  <div class="flex flex-col items-center w-full p-10 bg-sumi-100 rounded-xl">
    <h1 class="font-body text-sumi-900 font-bold text-xl">ログイン</h1>
    <div class="w-full flex justify-between mt-5">
      <form class="w-1/2 px-10 gap-4 flex flex-col border-r border-sumi-300">
        <FloatingInputFormItem label="メールアドレス" type="email" v-model:email="email" />
        <PasswordInputFormItem label="パスワード" type="password" v-model:password="password" />
        <button
          class="mt-5 w-full py-3 px-10 bg-sky-500 rounded-full text-body text-white font-semibold"
          type="submit"
        >
          ログイン
        </button>
      </form>
      <form class="w-1/2 px-10 flex flex-col items-center">
        <span class="font-body text-sumi-900">または</span>
        <button
          class="mt-5 w-full py-3 px-10 bg-sky-500 rounded-full text-body text-white font-semibold"
          type="submit"
        >
          ゲストとしてログイン
        </button>
      </form>
    </div>
  </div>
</template>