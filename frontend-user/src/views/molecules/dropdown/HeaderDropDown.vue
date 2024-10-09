<script setup lang="ts">
import { Menu, MenuButton, MenuItems } from '@headlessui/vue';
import type { Component } from 'vue';
import { useRouter } from 'vue-router';
import DropDownMenuItem from '@/views/atoms/DropDownMenuItem.vue';
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue';
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue';
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue';
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue';
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue';
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue';
import LogoutIcon from '@/views/atoms/icons/LogoutIcon.vue';
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue';

interface Props {
  readonly username: null | string;
  readonly avatarUrl: null | string;
}

interface MenuItem {
  label: string;
  icon: Component;
  name?: string;
  event:
    | 'toMyPage'
    | 'toPostDashboard'
    | 'toLikedPostDashboard'
    | 'toArchivedPostDashboard'
    | 'toTrashDashboard'
    | 'toSetting'
    | 'logout';
  props?: Record<string, string | null>;
}

const props = defineProps<Props>();

const emits = defineEmits<{
  (
    event:
      | 'toMyPage'
      | 'toPostDashboard'
      | 'toLikedPostDashboard'
      | 'toArchivedPostDashboard'
      | 'toTrashDashboard'
      | 'toSetting'
      | 'logout'
  ): void;
}>();

function handleMenuItem(
  event:
    | 'toMyPage'
    | 'toPostDashboard'
    | 'toLikedPostDashboard'
    | 'toArchivedPostDashboard'
    | 'toTrashDashboard'
    | 'toSetting'
    | 'logout'
) {
  emits(event);
}

const router = useRouter();

const menuItems: MenuItem[] = [
  {
    label: 'マイページ',
    name: 'UserPage',
    icon: AvatarIcon,
    event: 'toMyPage',
    props: { avatarUrl: props.avatarUrl }
  },
  { label: 'ダッシュボード', name: 'PostDashboard', icon: DashboardIcon, event: 'toPostDashboard' },
  {
    label: 'いいねした投稿',
    name: 'LikedPostDashboard',
    icon: HeartIcon,
    event: 'toLikedPostDashboard'
  },
  {
    label: '保存した投稿',
    name: 'ArchivedPostDashboard',
    icon: ArchiveIcon,
    event: 'toArchivedPostDashboard'
  },
  { label: 'ごみ箱', name: 'TrashDashboard', icon: TrashIcon, event: 'toTrashDashboard' },
  { label: '設定', name: 'Setting', icon: SettingIcon, event: 'toSetting' },
  { label: 'ログアウト', icon: LogoutIcon, event: 'logout' }
];
</script>
<template>
  <Menu as="div" class="relative" v-slot="{ open }">
    <BottomTooltip :open text="メニュー" position="bottom">
      <MenuButton class="peer flex h-8 w-8 items-center justify-center">
        <AvatarIcon :avatar-url />
      </MenuButton>
    </BottomTooltip>
    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <MenuItems
        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5"
      >
        <DropDownMenuItem
          v-for="item in menuItems"
          :key="item.event"
          @click="handleMenuItem(item.event)"
          :label="item.label"
          :is-active="router.currentRoute.value.name === item.name"
          :icon-component="item.icon"
          :icon-props="item.props"
          text-color-class="text-sumi-500"
        />
      </MenuItems>
    </transition>
  </Menu>
</template>
