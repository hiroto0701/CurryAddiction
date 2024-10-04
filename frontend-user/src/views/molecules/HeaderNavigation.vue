<script setup lang="ts">
import type { Component } from 'vue';
import { RouterLink, type RouteLocationRaw } from 'vue-router';
import { tv } from 'tailwind-variants';
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue';
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue';
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue';
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue';
import NotificationDropDown from '@/views/molecules/dropdown/NotificationDropDown.vue';
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue';

interface NavItem {
  name: string;
  component: Component;
  to?: RouteLocationRaw;
  props?: Record<string, string | null>;
  isMyPage?: boolean;
}

interface Props {
  handleName: string;
  avatarUrl: string | null;
}

const props = defineProps<Props>();

const navItems: NavItem[] = [
  { name: 'ホーム', component: HomeIcon, to: { name: 'Home' } },
  { name: '投稿する', component: PlusIcon, to: { name: 'PostCreate' } },
  { name: '検索する', component: SearchIcon, to: { name: 'Search' } },
  { name: 'お知らせ', component: NotificationDropDown },
  {
    name: 'マイページ',
    component: AvatarIcon,
    to: { name: 'UserPage', params: { username: props.handleName } },
    props: { avatarUrl: props.avatarUrl },
    isMyPage: true
  }
];

const navItemStyles = tv({
  base: 'flex items-center gap-0.5',
  variants: {
    isMyPage: {
      true: '',
      false: 'max-md:hidden'
    }
  }
});

const itemStyles = tv({
  base: 'peer flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100'
});
</script>
<template>
  <div class="flex items-center gap-0.5">
    <template v-for="item in navItems" :key="item.name">
      <div :class="navItemStyles({ isMyPage: item.isMyPage })">
        <BottomTooltip :text="item.name" position="bottom">
          <component :is="item.to ? RouterLink : 'div'" :to="item.to" :class="itemStyles()">
            <Suspense>
              <component :is="item.component" v-bind="item.props || {}" />
            </Suspense>
          </component>
        </BottomTooltip>
      </div>
    </template>
  </div>
</template>
