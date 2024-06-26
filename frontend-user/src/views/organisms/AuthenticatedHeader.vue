<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useRouter } from 'vue-router'
import AppLogo from '@/views/atoms/icons/AppLogo.vue'
import MainHeader from '@/views/atoms/MainHeader.vue'
import AuthenticatedHeaderDropDown from '@/views/molecules/dropdown/AuthenticatedHeaderDropDown.vue'
import HeaderNavigation from '@/views/molecules/HeaderNavigation.vue'
import LogoutConfirmModal from '@/views/molecules/modals/LogoutConfirmModal.vue'

const accountStore = useAccountStore()
const router = useRouter()
const modalOpen = ref<boolean>(false)

function openModal(): void {
  modalOpen.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  modalOpen.value = false
  document.body.style.overflow = 'auto'
}

function handleRouting(routeName: string): void {
  router.push({ name: routeName })
}

function doLogout(): void {
  accountStore.logout().then(() => {
    router.push({ name: 'Login' })
    document.body.style.overflow = 'auto'
  })
}
</script>
<template>
  <div>
    <MainHeader class="bg-curry py-4">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <AppLogo />
          <div class="flex items-center">
            <HeaderNavigation
              :handle-name="accountStore.state.handle_name"
              :avatar-url="accountStore.state.avatar_url"
            />
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
    </MainHeader>
    <Teleport to="body">
      <LogoutConfirmModal
        v-show="modalOpen"
        @do-logout="doLogout"
        @cancel="closeModal"
        :closeModal
      />
    </Teleport>
  </div>
</template>
