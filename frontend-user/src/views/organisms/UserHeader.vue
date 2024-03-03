<script setup lang="ts">
import AppLogo from '@/views/atoms/icons/AppLogo.vue'
import MainHeader from '@/views/atoms/MainHeader.vue';
import AuthenticatedDropDown from '@/views/molecules/dropdown/AuthenticatedDropDown.vue'
import NavigationIcons from '@/views/molecules/NavigationIcons.vue'


</script>
<template>
  <div>
    <MainHeader class="bg-curry">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <AppLogo />
          <div class="flex items-center">
            <NavigationIcons />
            <AuthenticatedDropDown />
          </div>
        </div>
      </div>
    </MainHeader>
  </div>
</template>