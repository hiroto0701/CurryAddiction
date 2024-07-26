<script setup lang="ts">
import { RouterLink } from 'vue-router'
import AppLogo from '@/views/atoms/icons/AppLogo.vue'
import MyProfileLink from '@/views/molecules/links/MyProfileLink.vue'
</script>
<template>
  <footer class="mt-auto bg-sumi-50 py-12">
    <div
      class="mx-auto flex w-full max-w-screen-lg flex-col justify-between gap-11 px-6 sm:px-20 md:flex-row"
    >
      <div class="flex w-fit flex-col gap-5">
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
    <small class="mx-auto mt-5 block w-fit select-none text-center font-body text-sumi-600">
      &copy; 2024 Curry Addiction
    </small>
  </footer>
</template>
