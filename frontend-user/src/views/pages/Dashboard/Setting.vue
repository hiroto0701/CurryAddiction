<script setup lang="ts">
import DashboardContent from '@/views/molecules/DashboardContent.vue'
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import DashboardSection from '@/views/molecules/DashboardSection.vue'
</script>
<template>
  <DashboardContent title="設定">
    <!-- プロフィール画像変更 -->
    <DashboardSection>
      <div class="flex items-center gap-5">
        <div class="relative aspect-square w-16">
          <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full">
        </div>
        <label class="inline-flex h-10 items-center duration-500 gap-2 rounded-full border px-3.5 text-xs cursor-pointer hover:opacity-70 hover:bg-slate-50">
          <span>プロフィール画像を変更</span>
        </label>
      </div>
    </DashboardSection>

    <!-- 表示名変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="表示名" />
      <p class="mt-3 text-sm text-utility">
        hiroto
      </p>
      <div class="mt-4">
        <button class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 hover:bg-slate-50 text-sm py-3 px-4">
          変更する
        </button>
      </div>
    </DashboardSection>
    
    <!-- お気に入りジャンル変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="カレーのジャンル" />
      <p class="mt-3 text-sm text-utility">
        お好みのカレーのジャンルを登録できます。
      </p>
      <div class="mt-4">
        <button class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 hover:bg-slate-50 text-sm py-3 px-4">
          変更する
        </button>
      </div>
    </DashboardSection>

    <!-- 都道府県変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="地方・都道府県" />
      <p class="mt-3 text-sm text-utility">
        表示する投稿の地域や都道府県を絞り込めます。
      </p>
      <div class="mt-4">
        <button class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 hover:bg-slate-50 text-sm py-3 px-4">
          変更する
        </button>
      </div>
    </DashboardSection>

    <!-- アカウント削除リンク -->
    <section class="flex justify-center">
      <p class="text-red-400 text-sm">アカウントの削除</p>
    </section>
  </DashboardContent>
</template>