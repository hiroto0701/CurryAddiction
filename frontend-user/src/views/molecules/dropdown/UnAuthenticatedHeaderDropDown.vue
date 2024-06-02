<script setup lang="ts">
import MainHeader from '@/views/atoms/MainHeader.vue'
import { Disclosure } from '@headlessui/vue'
import AppLogo from '@/views/atoms/icons/AppLogo.vue'
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue'
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue'
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue'
import NotificationIcon from '@/views/atoms/icons/NotificationIcon.vue'
import ProfileIcon from '@/views/atoms/icons/ProfileIcon.vue'
import AuthenticatedDropDown from '@/views/molecules/dropdown/AuthenticatedDropDown.vue'
</script>
<template>
  <MainHeader>
    <Disclosure as="nav" class="bg-curry">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <AppLogo />
          <div class="flex items-center">
            <div class="flex items-center gap-x-3.5">
              <HomeIcon />
              <PlusIcon />
              <SearchIcon />
              <NotificationIcon />
              <ProfileIcon />
            </div>
            <AuthenticatedDropDown />
          </div>
        </div>
      </div>
    </Disclosure>
  </MainHeader>
</template>
