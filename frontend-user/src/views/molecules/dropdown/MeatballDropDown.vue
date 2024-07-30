<script setup lang="ts">
import type { Component } from 'vue'
import { useRouter } from 'vue-router'
import { Menu, MenuButton, MenuItems } from '@headlessui/vue'
import MeatballMenuIcon from '@/views/atoms/icons/MeatballMenuIcon.vue'
import DropDownMenuItem from '@/views/atoms/DropDownMenuItem.vue'
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue'
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue'
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue'
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue'
import TopTooltip from '@/views/molecules/tooltips/TopTooltip.vue'

interface MeatBallMenuItem {
  readonly name: string
  readonly label: string
  readonly params?: Record<string, string>
  readonly icon: Component
  readonly iconProps?: Record<string, string | null>
}

interface Props {
  handleName: string
  avatarUrl: string | null
}
const props = defineProps<Props>()

const router = useRouter()

const menuItems: MeatBallMenuItem[] = [
  {
    name: 'Home',
    label: 'ホーム',
    icon: HomeIcon
  },
  {
    name: 'PostCreate',
    label: '投稿する',
    icon: PlusIcon
  },
  {
    name: 'Search',
    label: '検索する',
    icon: SearchIcon
  },
  {
    name: 'UserPage',
    label: 'マイページ',
    params: { username: props.handleName },
    icon: AvatarIcon,
    iconProps: { avatarUrl: props.avatarUrl }
  }
]

function handleRouting(routeName: string, params?: Record<string, string>): void {
  router.push({ name: routeName, params })
}

function getTextColorClass(routeName: string): string {
  return router.currentRoute.value.name === routeName ? 'text-sumi-900' : 'text-sumi-500'
}
</script>
<template>
  <Menu as="div" class="fixed bottom-9 left-3 z-40 md:left-14" v-slot="{ open }">
    <TopTooltip :open text="メニュー" position="top">
      <MenuButton
        class="peer flex h-16 w-16 items-center justify-center rounded-full border border-gray-300 bg-white opacity-70 shadow-sm duration-300 max-sm:h-14 max-sm:w-14 sm:hover:bg-slate-100 sm:hover:opacity-100"
        :class="[open ? 'w-24 max-sm:w-20' : '']"
        aria-label="ユーザーメニューを開く"
      >
        <MeatballMenuIcon class="w-7 text-sumi-900" v-show="!open" />
        <span class="font-body text-sm text-sumi-500" v-show="open">閉じる</span>
      </MenuButton>
    </TopTooltip>
    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <MenuItems
        class="absolute top-[-11rem] z-10 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5"
      >
        <DropDownMenuItem
          v-for="item in menuItems"
          :key="item.name"
          @click="handleRouting(item.name, item.params)"
          :label="item.label"
          :isActive="router.currentRoute.value.name === item.name"
          :textColorClass="getTextColorClass(item.name)"
          :iconComponent="item.icon"
          :icon-props="item.iconProps"
        />
      </MenuItems>
    </transition>
  </Menu>
</template>
