<script setup lang="ts">
import { RouterLink, type RouteLocationRaw } from 'vue-router';
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue';
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue';
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue';
import NotificationIcon from '@/views/atoms/icons/NotificationIcon.vue';
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue';
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue';

interface NavItem {
  name: string;
  icon: any;
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
  { name: 'ホーム', icon: HomeIcon, to: { name: 'Home' } },
  { name: '投稿する', icon: PlusIcon, to: { name: 'PostCreate' } },
  { name: '検索する', icon: SearchIcon, to: { name: 'Search' } },
  { name: 'お知らせ', icon: NotificationIcon },
  {
    name: 'マイページ',
    icon: AvatarIcon,
    to: { name: 'UserPage', params: { username: props.handleName } },
    props: { avatarUrl: props.avatarUrl },
    isMyPage: true
  }
];

const regularNavItems = navItems.filter((item) => !item.isMyPage);
const myPageItem = navItems.find((item) => item.isMyPage);
</script>
<template>
  <div class="flex items-center gap-0.5">
    <div class="flex items-center gap-0.5 max-sm:hidden">
      <template v-for="item in regularNavItems" :key="item.name">
        <BottomTooltip :text="item.name" position="bottom">
          <component
            :is="item.to ? RouterLink : 'div'"
            :to="item.to"
            class="peer flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100"
          >
            <component :is="item.icon" v-bind="item.props || {}" />
          </component>
        </BottomTooltip>
      </template>
    </div>

    <BottomTooltip v-if="myPageItem" :text="myPageItem.name" position="bottom">
      <component
        :is="myPageItem.to ? RouterLink : 'div'"
        :to="myPageItem.to"
        class="peer flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100"
      >
        <component :is="myPageItem.icon" v-bind="myPageItem.props || {}" />
      </component>
    </BottomTooltip>
  </div>
</template>
