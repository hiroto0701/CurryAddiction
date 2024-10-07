<script setup lang="ts">
import type { Component } from 'vue';
import { RouterLink, type RouteLocationRaw } from 'vue-router';
import { tv } from 'tailwind-variants';
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue';
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue';
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue';
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue';

interface NavItem {
  name: string;
  component: Component;
  to: RouteLocationRaw;
}

interface Props {
  handleName: string;
  avatarUrl: string | null;
}

defineProps<Props>();

const navItems: NavItem[] = [
  { name: 'ホーム', component: HomeIcon, to: { name: 'Home' } },
  { name: '投稿する', component: PlusIcon, to: { name: 'PostCreate' } },
  { name: '検索する', component: SearchIcon, to: { name: 'Search' } }
];

const itemStyles = tv({
  base: 'peer flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100'
});
</script>
<template>
  <div class="flex items-center gap-0.5">
    <template v-for="item in navItems" :key="item.name">
      <div class="flex items-center gap-0.5">
        <BottomTooltip :text="item.name" position="bottom">
          <component :is="item.to ? RouterLink : 'div'" :to="item.to" :class="itemStyles()">
            <component :is="item.component" />
          </component>
        </BottomTooltip>
      </div>
    </template>
  </div>
</template>
