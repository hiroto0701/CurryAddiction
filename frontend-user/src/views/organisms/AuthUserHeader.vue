<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useRouter } from 'vue-router'
import AppLogo from '@/views/atoms/icons/AppLogo.vue'
import MainHeader from '@/views/atoms/MainHeader.vue'
import AuthenticatedHeaderDropDown from '@/views/molecules/dropdown/AuthenticatedHeaderDropDown.vue'
import NavigationIcons from '@/views/molecules/NavigationIcons.vue'
import LogoutConfirmModal from '@/views/molecules/modals/LogoutConfirmModal.vue'

const accountStore = useAccountStore()
const router = useRouter()
const open = ref<boolean>(false)

const openModal = (): void => {
  open.value = true
  document.body.style.overflow = 'hidden'
}

const closeModal = (): void => {
  open.value = false
  document.body.style.overflow = 'auto'
}

const handleRouting = (routeName: string): void => {
  router.push({ name: routeName })
}

const doLogout = (): void => {
  accountStore.logout().then(() => {
    router.push({ name: 'Login' })
    document.body.style.overflow = 'auto'
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
    </MainHeader>
    <teleport to="body">
      <LogoutConfirmModal
        v-show="open" 
        @do-logout="doLogout" 
        @cancel="closeModal" 
        :closeModal
      />
    </teleport>
  </div>
</template>
