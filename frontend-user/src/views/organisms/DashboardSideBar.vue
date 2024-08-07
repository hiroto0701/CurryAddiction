<script setup lang="ts">
import { ref } from 'vue';
import type { Component } from 'vue';
import { useRouter } from 'vue-router';
import { tv } from 'tailwind-variants';
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue';
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue';
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue';
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue';
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue';
import BackButtonIcon from '@/views/atoms/icons/BackButtonIcon.vue';
import MenuBarIcon from '@/views/atoms/icons/MenuBarIcon.vue';
import DashBoardSidebarItem from '@/views/molecules/dashboard/DashboardSideBarItem.vue';

interface SidebarItem {
  readonly name: string;
  readonly label: string;
  readonly icon: Component;
}

const router = useRouter();
const sidebarItems: SidebarItem[] = [
  {
    name: 'PostDashboard',
    label: 'ダッシュボード',
    icon: DashboardIcon
  },
  {
    name: 'LikedPostDashboard',
    label: 'いいねした投稿',
    icon: HeartIcon
  },
  {
    name: 'ArchivedPostDashboard',
    label: '保存した投稿',
    icon: ArchiveIcon
  },
  {
    name: 'TrashDashboard',
    label: 'ごみ箱',
    icon: TrashIcon
  },
  {
    name: 'Setting',
    label: '設定',
    icon: SettingIcon
  }
];

function getTextColorClass(routeName: string): string {
  return router.currentRoute.value.name === routeName ? 'text-sumi-900' : 'text-sumi-500';
}

const isMenuOpen = ref<boolean>(false);

function openMenu(): void {
  isMenuOpen.value = true;
}

function closeMenu(): void {
  isMenuOpen.value = false;
}

const menuButton = tv({
  base: 'fixed right-3 top-8 flex h-12 w-12 items-center justify-center rounded-full border border-gray-300 bg-white opacity-70 shadow-sm duration-300',
  variants: {
    visibility: {
      hidden: 'md:hidden'
    }
  },
  defaultVariants: {
    visibility: 'hidden'
  },
  compoundVariants: [
    {
      visibility: 'hidden',
      class: 'md:hover:bg-slate-100 md:hover:opacity-100'
    }
  ]
});

const sidebar = tv({
  base: 'fixed left-0 top-0 z-20 h-full transform overflow-y-auto bg-white p-5 transition-transform duration-300 ease-in-out md:sticky',
  variants: {
    isOpen: {
      true: 'translate-x-0',
      false: '-translate-x-full md:translate-x-0'
    }
  },
  defaultVariants: {
    isOpen: false
  }
});

const overlay = tv({
  base: 'fixed inset-0 z-10 bg-black bg-opacity-50',
  variants: {
    visibility: {
      hidden: 'md:hidden'
    }
  },
  defaultVariants: {
    visibility: 'hidden'
  }
});
</script>
<template>
  <button :class="menuButton()" aria-label="ダッシュボードメニューを開く" @click="openMenu">
    <MenuBarIcon class="text-sumi-900" />
  </button>

  <aside :class="sidebar({ isOpen: isMenuOpen })" style="width: 258px">
    <DashBoardSidebarItem
      :to="{ name: 'Home' }"
      label="ホームへ"
      :iconComponent="BackButtonIcon"
      :isActive="router.currentRoute.value.name === 'Home'"
      :textColorClass="getTextColorClass('Home')"
    />
    <div class="mt-8 flex flex-col gap-2.5">
      <DashBoardSidebarItem
        v-for="item in sidebarItems"
        :key="item.name"
        :to="{ name: item.name }"
        :label="item.label"
        :iconComponent="item.icon"
        :isActive="router.currentRoute.value.name === item.name"
        :textColorClass="getTextColorClass(item.name)"
        @click="closeMenu"
      />
    </div>
  </aside>

  <div v-if="isMenuOpen" :class="overlay()" @click="closeMenu"></div>
</template>
