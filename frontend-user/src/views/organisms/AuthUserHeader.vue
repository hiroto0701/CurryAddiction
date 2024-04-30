<script setup lang="ts">
import { useAccountStore } from '@/stores/account'
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import AppLogo from '@/views/atoms/icons/AppLogo.vue'
import MainHeader from '@/views/atoms/MainHeader.vue'
import AuthenticatedHeaderDropDown from '@/views/molecules/dropdown/AuthenticatedHeaderDropDown.vue'
import NavigationIcons from '@/views/molecules/NavigationIcons.vue'
import BaseButton from '@/views/atoms/BaseButton.vue'
import CloseIcon from '@/views/atoms/icons/CloseIcon.vue'

const showContent = ref(false)
const openModal = () => {
  showContent.value = true;
};

const closeModal = () => {
  showContent.value = false;
};

const accountStore = useAccountStore()
const router = useRouter()

const handleRouting = (routeName: string): void => {
  router.push({ name: routeName })
}

const doLogout = (): void => {
  accountStore.logout().then(() => {
    router.push({ name: 'Login' })
  })
}
</script>

<template>
  <div>
    <MainHeader class="bg-curry">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <AppLogo />
          <div class="flex items-center">
            <NavigationIcons />
            <AuthenticatedHeaderDropDown
              :username="accountStore.state.display_name"
              @to-post-dashboard="handleRouting('PostDashboard')"
              @to-liked-post-dashboard="handleRouting('LikedPostDashboard')"
              @to-archived-post-dashboard="handleRouting('ArchivedPostDashboard')"
              @to-trash-dashboard="handleRouting('TrashDashboard')"
              @to-setting="handleRouting('Setting')"
              @logout="openModal"
            />
          </div>
        </div>
      </div>

      <div
        class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50 z-10 backdrop-blur-sm"
        v-show="showContent"
        @click.self="closeModal"
      >
        <CloseIcon class="fixed top-6 right-6 inline-flex justify-center items-center text-white bg-gray-400 rounded-full w-8 p-1 cursor-pointer" @click.self="closeModal" />
        <div class="modal z-20 bg-white flex flex-col gap-4 p-8 rounded-lg">
          <p class="font-body w-fit mx-auto text-sumi-900 text-lg">ログアウトしますか？</p>
          <p class="font-body w-fit mx-auto text-sumi-500 text-sm">@{{ accountStore.state.handle_name }}としてログインしています</p>
          <BaseButton class="border border-gray-300 p-3" text="ログアウト" @click.self="doLogout" />
          <BaseButton class="border border-gray-300 p-3" text="キャンセル" @click.self="closeModal" />
        </div>
      </div>

    </MainHeader>
  </div>
</template>
<style scoped>
.modal {
  animation-name: slide-in;
  animation-duration: 3s;
  animation-iteration-count: 1;
  animation-fill-mode: forwards;
}

@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translate(0, 30px);
  }
  10% {
    opacity: 0.9;
    transform: translate(0, 0);
  }
  100% {
    opacity: 1;
    transform: translate(0, 0);
  }
}
</style>
