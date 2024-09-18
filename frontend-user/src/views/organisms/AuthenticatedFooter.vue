<script setup lang="ts">
import { ref } from 'vue';
import { useRouter, RouterLink } from 'vue-router';
import { useAccountStore } from '@/stores/account';
import { useCommonStore } from '@/stores/common';
import AppLogo from '@/views/atoms/icons/AppLogo.vue';
import LogoutButton from '@/views/molecules/buttons/LogoutButton.vue';
import CurrentUserProfileLink from '@/views/molecules/links/CurrentUserProfileLink.vue';
import ActionConfirmModal from '@/views/molecules/modals/ActionConfirmModal.vue';

const accountStore = useAccountStore();
const commonStore = useCommonStore();
const router = useRouter();
const open = ref<boolean>(false);

function openModal(): void {
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  open.value = false;
  document.body.style.overflow = 'auto';
}

function doLogout(): void {
  accountStore.logout().then(() => {
    router.push({ name: 'Welcome' });
    document.body.style.overflow = 'auto';
  });
}
</script>
<template>
  <footer class="mt-auto bg-sumi-50 py-12">
    <div
      class="mx-auto flex w-full max-w-screen-lg flex-col justify-between gap-11 px-6 sm:px-20 md:flex-row"
    >
      <div class="flex w-fit flex-col gap-5">
        <AppLogo />
        <div class="flex items-center justify-between">
          <CurrentUserProfileLink />
          <LogoutButton class="text-sm" text="ログアウト" @click="openModal" />
        </div>
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
  <Teleport to="body">
    <ActionConfirmModal
      v-show="open"
      :is-loading="commonStore.state.apiLoading"
      modal-title="ログアウトしますか？"
      :modal-content="`@${accountStore.state.handle_name}としてログインしています`"
      button-text="ログアウト"
      @commit="doLogout"
      @cancel="closeModal"
      :closeModal="closeModal"
    />
  </Teleport>
</template>
