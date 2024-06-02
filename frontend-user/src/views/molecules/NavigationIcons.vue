<script setup lang="ts">
import { RouterLink } from 'vue-router'
import HomeIcon from '@/views/atoms/icons/HomeIcon.vue'
import PlusIcon from '@/views/atoms/icons/PlusIcon.vue'
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue'
import NotificationIcon from '@/views/atoms/icons/NotificationIcon.vue'
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue'
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue'
</script>
<template>
  <div class="flex items-center gap-0.5 max-md:hidden">
    <BottomTooltip text="ホーム" position="bottom">
      <router-link
        :to="{ name: 'Home' }"
        class="peer w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
      >
        <HomeIcon class="peer" />
      </router-link>
    </BottomTooltip>

    <BottomTooltip text="投稿する" position="bottom">
      <router-link
        :to="{ name: 'PostCreate' }"
        class="peer w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
      >
        <PlusIcon />
      </router-link>
    </BottomTooltip>

    <BottomTooltip text="検索する" position="bottom">
      <router-link
        :to="{ name: 'Search' }"
        class="peer w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
      >
        <SearchIcon />
      </router-link>
    </BottomTooltip>

    <BottomTooltip text="お知らせ" position="bottom">
      <div
        class="peer w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
      >
        <NotificationIcon />
      </div>
    </BottomTooltip>

    <BottomTooltip text="マイページ" position="bottom">
      <router-link
        :to="{ name: 'UserPage' }"
        class="peer w-8 aspect-square rounded-full transition-opacity duration-500 cursor-pointer hover:bg-gray-100 flex items-center justify-center"
      >
        <AvatarIcon />
      </router-link>
    </BottomTooltip>
  </div>
</template>
