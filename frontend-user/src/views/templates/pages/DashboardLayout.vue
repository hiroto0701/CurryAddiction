<script setup lang="ts">
import DashboardIcon from '@/views/atoms/icons/DashboardIcon.vue';
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue';
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue';
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue';
import SettingIcon from '@/views/atoms/icons/SettingIcon.vue';
</script>

<template>
  <div class="min-h-full">
    <div class="flex">
      <aside class="sticky top-0 hidden p-5 md:block" style="width: 260px">
        <div>
          <a href="">ユーザホームページへのリンク</a>
          <div class="mt-8 flex flex-col gap-2.5">
            <a class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600"><DashboardIcon />ダッシュボード</a>
            <a class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600"><HeartIcon />いいねした投稿</a>
            <a class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600"><ArchiveIcon />保存した投稿</a>
            <a class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600"><TrashIcon />ごみ箱</a>
            <a class="flex px-3 h-11 gap-2.5 rounded-lg items-center text-slate-600"><SettingIcon />設定</a>
          </div>
        </div>
      </aside>
      <main class="min-h-screen min-w-0 flex-1 pb-32 md:border-l md:border-main-150">
        メインエリア
      </main>
    </div>
  </div>
</template>