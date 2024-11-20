<script setup lang="ts">
import { useRoute, RouterLink } from 'vue-router';
import AppLogo from '@/views/atoms/icons/AppLogo.vue';
import LoginButton from '@/views/molecules/buttons/LoginButton.vue';

const route = useRoute();

const emits = defineEmits<{
  (e: 'openModal'): void;
}>();
</script>

<template>
  <footer class="mt-auto bg-sumi-50 py-12">
    <div
      class="xs:px-7 mx-auto flex w-full max-w-screen-lg flex-col justify-between gap-11 px-6 sm:px-10 md:flex-row"
    >
      <div class="flex w-fit flex-col gap-5">
        <AppLogo />
        <LoginButton
          v-if="route.name !== 'Signup'"
          class="mx-auto"
          text="ログイン"
          @click="emits('openModal')"
        />
      </div>
      <div class="flex flex-col gap-4">
        <router-link :to="{ name: 'PrivacyPolicy' }" class="font-body text-sumi-600">
          プライバシーポリシー
        </router-link>

        <router-link :to="{ name: 'Terms' }" class="font-body text-sumi-600">
          利用規約
        </router-link>
        <a
          class="block w-fit font-body text-sumi-600"
          href="https://forms.gle/JZk6xHmwX98snLbw6"
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
