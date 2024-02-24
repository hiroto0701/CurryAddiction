<script setup lang="ts">
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import DashboardSection from '@/views/molecules/DashboardSection.vue'
import DashboardContent from '@/views/molecules/DashboardContent.vue'
</script>
<template>
  <DashboardContent title="投稿ダッシュボード">
    <DashboardSection>
      <div class="flex items-center gap-3.5 py-6">
        <div class="aspect-square w-14">
          <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full">
        </div>
        <div class="flex-1 leading-normal">
          <div class="break-all text-md text-main">hiroto</div>
          <a class="font-intel mt-1 inline-flex text-sm text-utility hover:underline" href="#">curry-addiction/hiroto</a>
        </div>
        <span class="hidden md:inline">
          <a class="inline-flex items-center justify-center duration-500 hover:opacity-70 hover:bg-slate-50 text-main border rounded-full text-xs py-2.5 px-3.5" href="/dashboard/settings">
            設定
          </a>
        </span>
      </div>
  
      <div>
        <dl class="leading-normal">
          <div class="flex items-center min-h-14">
            <dt class="flex items-center">
              <span class="inline-flex w-7 items-center text-main-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-utility">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
              </span>
              <span class="text-utility text-sm w-28">利用開始</span>
            </dt>
            <dd class="flex min-w-0 flex-1 items-center text-main text-sm">2024年1月</dd>
          </div>
          <div class="flex items-center border-t min-h-14">
            <dt class="flex items-center">
              <span class="inline-flex w-7 items-center text-main-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square  text-utility">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
              </span>
              <span class="text-utility text-sm w-28">記事数</span>
            </dt>
            <dd class="flex items-center text-main text-sm">0</dd>
          </div>
        </dl>
      </div>
    </DashboardSection>

    <DashboardSection>
      <DashboardSectionHeader title="アクティビティ" />
    </DashboardSection>
  </DashboardContent>
</template>