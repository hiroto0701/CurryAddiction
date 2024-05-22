<script setup lang="ts">
import LoginButton from '@/views/molecules/buttons/LoginButton.vue'
</script>
<template>
  <h1 class="font-body text-sumi-900 w-fit mx-auto text-2xl">アカウントを作成します</h1>
  <div class="flex flex-col items-center mx-auto mt-5 p-10 bg-sumi-100 rounded-xl">
    <h2 class="font-body text-sumi-900 w-fit mx-auto text-lg">ハンドルネームを決めましょう</h2>
    <form class="px-5 gap-4 flex flex-col items-center">
      <div class="flex items-center mt-5">
        <div class="font-body text-sumi-900">curry-addiction/</div>
        <input class="block ml-1 font-body text-sumi-900 p-3 rounded-lg border border-gray-300" type="text">
      </div>
      <LoginButton text="確定する" />
    </form>
  </div>
  <!-- 全ての状態管理をリセットしてログイン画面へ戻る -->
  <button class="block w-fit mx-auto mt-5 pb-1 font-body text-sumi-500 hover:text-sumi-900 duration-300 border-b-2 border-dotted border-sumi-300 hover:border-sumi-900">アカウント作成をやめる</button>
</template>
