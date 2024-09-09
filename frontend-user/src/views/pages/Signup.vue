<script setup lang="ts">
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAccountStore } from '@/stores/account';
import { useAccountFormStore } from '@/stores/account_form';
import { useCommonStore } from '@/stores/common';
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue';
import LogoWithTextIcon from '@/views/atoms/icons/LogoWithTextIcon.vue';
import LoginButton from '@/views/molecules/buttons/LoginButton.vue';
import AccountAbortConfirmModal from '@/views/molecules/modals/AccountAbortConfirmModal.vue';
import HandleNameFormItem from '@/views/molecules/formItems/HandleNameFormItem.vue';

const router = useRouter();
const accountStore = useAccountStore();
const accountFormStore = useAccountFormStore();
const commonStore = useCommonStore();

const open = ref<boolean>(false);
const handleName = ref<string>('');

const handleNameError = computed((): boolean => 'handle_name' in accountFormStore.state.errors);
const handleNameLengthError = computed((): boolean => {
  return handleName.value.length < 2 || handleName.value.length > 20;
});

function openModal(): void {
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  open.value = false;
  document.body.style.overflow = 'auto';
}

function accountAbort(): void {
  accountStore.resetData();
  accountFormStore.resetData();
  router.push({ name: 'Top' });
}

async function doLogin(): Promise<void> {
  if (accountFormStore.handleNameValidate(handleName.value)) {
    commonStore.startApiLoading();
    try {
      const loginSuccess: boolean = await accountFormStore.registerAndLogin(handleName.value);
      if (loginSuccess) {
        closeModal();
      }
    } finally {
      commonStore.stopApiLoading();
    }
  }
}
</script>
<template>
  <main>
    <div class="py-10">
      <div class="xs:px-7 mx-auto w-full max-w-[600px] px-6 sm:px-10">
        <div class="flex justify-center">
          <LogoWithTextIcon class="w-24" />
        </div>
        <h1 class="mx-auto mt-3 w-fit font-body text-lg text-sumi-900">アカウントを作成します</h1>
        <div class="mx-auto mt-5 flex flex-col items-center rounded-3xl bg-slate-100 p-6">
          <h2 class="mx-auto w-fit font-body text-lg text-sumi-900">
            ハンドルネームを決めましょう
          </h2>
          <form class="px-5" @submit.prevent="doLogin">
            <div class="mt-5 flex items-center">
              <div class="font-body text-sumi-600">curry-addiction/</div>
              <div class="relative">
                <HandleNameFormItem class="ml-1" v-model="handleName" :is-error="handleNameError" />
                <ErrorIcon
                  v-if="handleNameError"
                  class="absolute right-3 top-1/2 -translate-y-1/2"
                />
              </div>
            </div>
            <span
              class="mt-2 flex justify-end"
              :class="{
                'text-sumi-500': !handleNameLengthError,
                'text-red-400': handleNameLengthError
              }"
            >
              {{ handleName ? handleName.length : 0 }} / 20
            </span>
            <p
              v-show="accountFormStore.state.errors.handle_name"
              class="mx-auto w-fit font-body text-xs text-red-400"
            >
              {{ accountFormStore.state.errors?.handle_name?.[0] }}
            </p>
            <div class="flex items-center">
              <LoginButton
                class="mx-auto mt-5 w-fit"
                :is-loading="commonStore.state.apiLoading"
                :disabled="commonStore.state.apiLoading"
                text="確定する"
              />
            </div>
          </form>
        </div>
        <button
          class="mx-auto mt-5 block w-fit border-b-2 border-dotted border-sumi-300 pb-1 font-body text-sumi-500 duration-300 hover:border-sumi-900 hover:text-sumi-900"
          @click="openModal"
        >
          アカウント作成をやめる
        </button>
      </div>
    </div>

    <Teleport to="body">
      <AccountAbortConfirmModal
        v-show="open"
        @abort="accountAbort"
        @cancel="closeModal"
        :closeModal="closeModal"
      />
    </Teleport>
  </main>
</template>
