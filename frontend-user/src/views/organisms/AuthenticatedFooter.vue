<script setup lang="ts">
import { RouterLink } from 'vue-router'
import AppLogo from '@/views/atoms/icons/AppLogo.vue'
import MyProfileLink from '@/views/molecules/links/MyProfileLink.vue'
</script>
<template>
  <footer class="bg-sumi-50 mt-auto py-12">
    <div
      class="mx-auto w-full px-6 sm:px-20 max-w-screen-lg flex flex-col gap-11 justify-between md:flex-row"
    >
      <div class="flex flex-col w-fit gap-5">
        <AppLogo />
        <MyProfileLink />
      </div>
      <div class="flex flex-col gap-4">
        <router-link :to="{ name: 'PrivacyPolicy' }" class="font-body text-sumi-600">
          プライバシーポリシー
        </router-link>
        <a
          class="font-body text-sumi-600"
          href="https://forms.gle/roKqweFnKA8vMcSR9"
          target="_blank"
          rel="noopener noreferrer"
          >お問い合わせ
        </a>
      </div>
    </div>
    <small class="font-body text-sumi-600 text-center w-fit mt-5 mx-auto block select-none">
      &copy; 2024 Curry Addiction
    </small>
  </footer>
</template>
