<script setup lang="ts">
import { ref } from 'vue';
import { useAccountStore } from '@/stores/account';
import { useAccountFormStore } from '@/stores/account_form';
import { useCommonStore } from '@/stores/common';
import CameraIcon from '@/views/atoms/icons/CameraIcon.vue';
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue';
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue';
import LoginButton from '@/views/molecules/buttons/LoginButton.vue';
import LoginModal from '@/views/molecules/modals/LoginModal.vue';
import EmailRegisterModal from '@/views/molecules/modals/EmailRegisterModal.vue';
import TokenSubmitModal from '@/views/molecules/modals/TokenSubmitModal.vue';
import LpLogo from '@/views/molecules/lpComponents/LpLogo.vue';
import LpText from '@/views/molecules/lpComponents/LpText.vue';
import FeatureCard from '@/views/molecules/lpComponents/FeatureCard.vue';
import UnAuthenticatedFooter from '@/views/organisms/UnAuthenticatedFooter.vue';

const accountStore = useAccountStore();
const accountFormStore = useAccountFormStore();
const commonStore = useCommonStore();
const email = ref<string>('');
const token = ref<string>('');
const modalState = ref<'login' | 'email' | 'token' | null>(null);

function openModal(modalName: 'login' | 'email' | 'token'): void {
  modalState.value = modalName;

  // モーダルを開くたびに入力データをリセット
  if (modalState.value === 'login') {
    email.value = '';
    token.value = '';
  }
  accountStore.resetErrors();
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  modalState.value = null;
  document.body.style.overflow = 'auto';
}

async function generateToken(): Promise<boolean> {
  if (!accountStore.emailValidate(email.value)) return false;

  accountFormStore.setEmail(email.value);
  commonStore.startApiLoading();
  const response: boolean = await accountStore.generateToken({ email: email.value });
  commonStore.stopApiLoading();

  if (response) {
    closeModal();
    openModal('token');
    return true;
  }

  return false;
}

async function login(): Promise<boolean> {
  if (!accountStore.tokenValidate(token.value)) return false;

  accountFormStore.setToken(token.value);
  commonStore.startApiLoading();
  const loginSuccess: boolean = await accountStore.login({
    email: email.value,
    token: token.value
  });
  commonStore.stopApiLoading();

  if (loginSuccess) {
    closeModal();
    return true;
  }

  return false;
}
</script>
<template>
  <main class="xs:px-7 mx-auto w-full max-w-screen-md px-6 py-20 sm:px-10">
    <section>
      <LpLogo title="Curry Addiction" sub-title="カレー好きのためのSNS" />
      <div class="mt-6 flex justify-center">
        <LoginButton text="ログイン" @click="openModal('login')" />
      </div>
    </section>

    <section class="mt-16 flex flex-col items-center gap-8">
      <LpText
        text="Curry Addictionは、カレー好きのためのSNSです。好きなカレーを気軽に投稿して、辛さや具材、お店の雰囲気までカレーに関するすべてを共有しましょう。自分だけのカレーコレクションを作り上げていくことができます。"
      />
      <LpText
        text="カレーが大好きな作者が、もっと色んなカレーを知りたい！そして食べたカレーを共有することで、同じようなカレー好きの人に新たなカレーを知ってもらいたい！というカレーに対する熱い思いを込めてこのサービスを作り上げました。"
      />
      <LpText
        text="このサービスで、カレーとの出会いを記録し、依存症（addiction）になるほどカレーにハマるきっかけになればと思っています。"
      />
    </section>

    <section class="grid grid-cols-1 gap-4 py-12 sm:grid-cols-3">
      <FeatureCard
        :icon="CameraIcon"
        title="カレーを投稿"
        text="美味しかったカレーの写真と感想を共有しよう"
      />
      <FeatureCard
        :icon="HeartIcon"
        title="いいね &amp; 保存"
        text="お気に入りの投稿にいいねをしたり、保存したりできます"
      />
      <FeatureCard
        :icon="SearchIcon"
        title="カレーを検索"
        text="近くの美味しいカレー店を簡単に見つけられます"
      />
    </section>

    <div class="mt-16 flex flex-col gap-5">
      <div class="border-sumi-150 rounded-3xl border p-7 sm:flex sm:p-8">
        <div
          class="xs:gap-5 xs:text-md sm:text-md flex flex-1 flex-col items-start gap-4 text-sm leading-relaxed"
        >
          <h2 class="font-body text-sumi-900">
            早速Curry Addictionに参加して、あなただけのカレーコレクションを作り上げましょう。
          </h2>
          <LoginButton text="ログイン" @click="openModal('login')" />
        </div>
        <div class="-mt-4 flex justify-end sm:mt-6">
          <img
            src="http://localhost:9000/local-curry_addiction/illust/circle_of_people.svg"
            class="w-44"
            alt=""
          />
        </div>
      </div>
    </div>

    <form
      @submit.prevent="login"
      class="flex w-1/2 flex-col gap-4 border-r border-sumi-300 px-10"
      novalidate
    >
      <Teleport to="body">
        <LoginModal
          v-show="modalState === 'login'"
          @start-login="openModal('email')"
          :closeModal="closeModal"
        />
        <EmailRegisterModal
          v-show="modalState === 'email'"
          v-model="email"
          @send-email="generateToken"
          :closeModal="closeModal"
        />
        <TokenSubmitModal
          v-show="modalState === 'token'"
          v-model="token"
          :email="email"
          @do-login="login"
          :closeModal="closeModal"
        />
      </Teleport>
    </form>
  </main>
  <UnAuthenticatedFooter @open-modal="openModal('login')" />
</template>
