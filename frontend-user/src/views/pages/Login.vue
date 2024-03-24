<script setup lang="ts">
import { ref } from 'vue'
// import FloatingInputFormItem from '@/views/molecules/formItems/FloatingInputFormItemItem.vue'

const email = ref<string>('');
const password = ref<string>('');
const emailFocus = ref<boolean>(false);
const passwordFocus = ref<boolean>(false);
</script>
<template>
  <div class="flex flex-col items-center w-full p-10 bg-sumi-100 rounded-xl">
    <h1 class="font-body text-sumi-900 font-bold text-xl">ログイン</h1>
    <div class="w-full flex justify-between mt-5">
      <form class="w-1/2 px-10 gap-4 flex flex-col border-r border-sumi-300">
        <div class="relative">
          <label 
            for="email"
            class="absolute font-body text-sumi-500 pl-3 font-semibold transition-all duration-300"
            :class="{
              'text-mini top-1': emailFocus || email,
              'text-sm top-5': !emailFocus && !email,
            }"
          >メールアドレス</label>
          <input 
            type="email"
            id="email"
            class="w-full font-body text-sumi-900 px-3 pt-4 h-14 rounded-lg transition-all duration-300"
            v-model="email"
            @focus="emailFocus = true"
            @blur="emailFocus = false"
          >
        </div>
  
        <div class="relative">
          <label 
            for="password"
            class="absolute font-body text-sumi-500 pl-3 font-semibold transition-all duration-300"
            :class="{
              'text-mini top-1': passwordFocus || password,
              'text-sm top-5': !passwordFocus && !password,
            }"
          >パスワード</label>
          <input
            type="password"
            id="password"
            class="w-full font-body text-sumi-900 px-3 pt-4 h-14 rounded-lg transition-all duration-300"
            v-model="password"
            @focus="passwordFocus = true"
            @blur="passwordFocus = false"
          >
        </div>
        <FloatingInputFormItem label="test" type="password" />
  
        <button class="mt-5 w-full py-3 px-10 bg-sky-500 rounded-full text-body text-white font-semibold" type="submit">ログイン</button>
      </form>
      <form class="w-1/2 px-10 flex flex-col items-center">
        <span class="font-body text-sumi-900">または</span>
        <button class="mt-5 w-full py-3 px-10 bg-sky-500 rounded-full text-body text-white font-semibold" type="submit">ゲストとしてログイン</button>
      </form>
    </div>
  </div>
</template>