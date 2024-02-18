<script setup lang="ts">
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue';
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue';
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue';
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue';
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue';
import BackButtonIcon from '@/views/atoms/icons/BackButtonIcon.vue';
import { RouterLink } from 'vue-router';
import { useRouter } from 'vue-router';

const router = useRouter();

const isActive = (routeName: string): boolean => {
  return router.currentRoute.value.name === routeName;
};
</script>

<template>
  <div class="min-h-full font-body">
    <div class="flex">
      <aside class="sticky top-0 hidden p-5 md:block" style="width: 258px">
        <div>
          <router-link :to="{ name: 'Home' }" class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600 hover:bg-slate-100">
            <BackButtonIcon />ホームへ
          </router-link>
          <div class="mt-8 flex flex-col gap-2.5">
            <router-link :to="{ name: 'PostDashboard' }" class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600 hover:bg-slate-100"
                         :class="{ 'bg-slate-100 text-main': isActive('PostDashboard') }"
            >
              <DashboardIcon />ダッシュボード
            </router-link>
            <router-link :to="{ name: 'LikedPostDashboard' }" class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600 hover:bg-slate-50"
                         :class="{ 'bg-slate-100 text-main': isActive('LikedPostDashboard') }"
            >
              <HeartIcon />いいねした投稿
            </router-link>
            <router-link :to="{ name: 'ArchivedPostDashboard' }" class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600 hover:bg-slate-50"
                         :class="{ 'bg-slate-100 text-main': isActive('ArchivedPostDashboard') }"
            >
              <ArchiveIcon />保存した投稿
            </router-link>
            <router-link :to="{ name: 'TrashDashboard' }" class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600 hover:bg-slate-50"
                         :class="{ 'bg-slate-100 text-main': isActive('TrashDashboard') }"
            >
              <TrashIcon />ごみ箱
            </router-link>
            <router-link :to="{ name: 'Settings' }" class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600 hover:bg-slate-50"
                         :class="{ 'bg-slate-100 text-main': isActive('Settings') }"
            >
              <SettingIcon />設定
            </router-link>
          </div>
        </div>
      </aside>
      <main class="min-h-screen min-w-0 flex-1 pb-32 md:border-l md:border-main-150">
        メインエリア
      </main>
    </div>
  </div>
</template>