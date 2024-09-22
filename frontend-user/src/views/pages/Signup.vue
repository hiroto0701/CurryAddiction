<script setup lang="ts">
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAccountStore } from '@/stores/account';
import { useAccountFormStore } from '@/stores/account_form';
import { useCommonStore } from '@/stores/common';
import LpLogo from '@/views/molecules/lpComponents/LpLogo.vue';
import ErrorIcon from '@/views/atoms/icons/ErrorIcon.vue';
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

const handleNameCountClass = computed((): string => {
  if (handleName.value.length === 0) {
    return 'text-sumi-500';
  }
  return handleNameLengthError.value ? 'text-red-400' : 'text-sumi-500';
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
  document.body.style.overflow = 'auto';
  router.push({ name: 'Welcome' });
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
    <div class="mx-auto w-full max-w-[600px] px-6 py-10 sm:px-10">
      <LpLogo title="Curry Addiction" sub-title="アカウントを作成します" />
      <div class="mx-auto mt-5 flex flex-col items-center rounded-3xl bg-slate-100 p-6">
        <h2 class="mx-auto w-fit font-body text-lg text-sumi-900">ハンドルネームを決めましょう</h2>
        <form class="w-full px-5 sm:px-16" @submit.prevent="doLogin">
          <div
            class="justify-stat mt-5 flex flex-col items-start gap-3 sm:flex-row sm:items-center sm:gap-0"
          >
            <div class="font-body text-sumi-600">curry-addiction /</div>
            <div class="relative w-full flex-1">
              <HandleNameFormItem
                class="w-full sm:ml-1"
                v-model="handleName"
                :is-error="handleNameError"
              />
              <ErrorIcon v-if="handleNameError" class="absolute right-3 top-1/2 -translate-y-1/2" />
            </div>
          </div>
          <span class="mt-2 flex justify-end" :class="handleNameCountClass">
            {{ handleName.length }} / 20
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
