<script setup lang="ts">
import DashboardContent from '@/views/molecules/DashboardContent.vue'
</script>
<template>
  <DashboardContent title="投稿ダッシュボード">
    <section class="overflow-hidden rounded-2xl border">
      <div class="flex items-center gap-3.5 border-b border-main-150 py-6 px-5 sm:px-8">
        <div class="relative aspect-square w-14">
          <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full">
        </div>
        <div class="flex-1 leading-normal">
          <div class="break-all text-md">hiroto</div>
          <a class="font-family-latin mt-1 inline-flex text-sm text-utility decoration-main-300 hover:underline" href="#">curry-addiction/hiroto</a>
        </div>
        <span class="hidden md:inline">
          <a class="inline-flex items-center justify-center duration-500 leading-[1.1] bg-main-bg text-main-body border border-main-300 rounded-full disabled:border-main-200 disabled:opacity-60 hover:bg-main-50 hover:border-main-400 hover:disabled:bg-main-bg text-xs py-2.5 px-3.5" href="/dashboard/settings">
            設定
          </a>
        </span>

        <!-- <div class="flex items-center gap-5">
          <div class="relative aspect-square w-16">
            <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full">
          </div>
          <div class="flex flex-col">
            <p>hiroto</p>
            <p class="text-utility">curry-addiction/hiroto</p>
          </div>
        </div>
        <label class="inline-flex h-10 items-center duration-500 gap-2 rounded-full border px-3.5 text-xs cursor-pointer hover:opacity-70">
          <span>設定</span>
        </label> -->
      </div>

      <div class="pt-0.5 pb-3 text-xs sm:text-sm px-5 sm:px-8">
        <dl class="leading-normal">
          <div class="flex items-center" style="min-height: 54px;">
            <dt class="flex items-center">
              <span class="inline-flex items-center text-main-500" style="width: 27px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-utility">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
              </span>
              <span class="tracking-wide text-utility" style="width: 110px; font-size: 0.92em;">利用開始</span>
            </dt>
            <dd class="flex min-w-0 flex-1 items-center py-1.5">2024<span class="mx-0.5 text-3xs">年</span>1<span class="ml-0.5 text-3xs">月</span></dd>
          </div>
          <div class="flex items-center border-t border-main-150" style="min-height: 54px;">
            <dt class="flex items-center">
              <span class="inline-flex items-center text-main-500" style="width: 27px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square  text-utility">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
              </span>
              <span class="tracking-wide text-utility" style="width: 110px; font-size: 0.92em;">記事数</span></dt>
              <dd class="flex min-w-0 flex-1 items-center py-1.5">
                <div class="flex flex-wrap items-baseline gap-1">0</div>
              </dd>
            </div>
          </dl>
        </div>
    </section>
  </DashboardContent>
</template>