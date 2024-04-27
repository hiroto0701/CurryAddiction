<script setup lang="ts">
import { useAccountStore } from '@/stores/account'
import AppLogo from '@/views/atoms/icons/AppLogo.vue'
import MainHeader from '@/views/atoms/MainHeader.vue'
import AuthenticatedHeaderDropDown from '@/views/molecules/dropdown/AuthenticatedHeaderDropDown.vue'
import NavigationIcons from '@/views/molecules/NavigationIcons.vue'

const accountStore = useAccountStore()

</script>
<template>
  <div>
    <MainHeader class="bg-curry">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <AppLogo />
          <div class="flex items-center">
            <NavigationIcons />
            <AuthenticatedHeaderDropDown :username="accountStore.state.display_name" />
          </div>
        </div>
      </div>
    </MainHeader>
  </div>
</template>
