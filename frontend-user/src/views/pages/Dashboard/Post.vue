<script setup lang="ts">
import PostIcon from '@/views/atoms/icons/PostIcon.vue'
import CalenderIcon from '@/views/atoms/icons/CalenderIcon.vue'
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue'
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue'
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue'
</script>
<template>
  <DashboardContent title="投稿ダッシュボード">
    <DashboardSection>
      <!-- <div class="flex items-center gap-3.5 py-6">
        <div class="aspect-square w-14">
          <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full">
        </div>
        <div class="flex-1 leading-normal">
          <DisplayNameBrowseItem value="hiroto" class="break-all text-md text-main font-body" />
          <a class="font-intel mt-1 inline-flex text-sm text-utility hover:underline" href="#">curry-addiction/hiroto</a>
        </div>
        <span>
          <a class="inline-flex items-center justify-center duration-500 hover:opacity-70 hover:bg-slate-50 text-main border rounded-full text-xs py-2.5 px-3.5" href="/dashboard/settings">
            設定
          </a>
        </span>
      </div> -->
  
      <div>
        <dl class="leading-normal">
          <div class="flex items-center min-h-14">
            <dt class="flex items-center">
              <span class="inline-flex w-7 items-center text-sumi-900 font-body">
              <CalenderIcon class="text-sumi-500" />
              </span>
              <span class="text-sumi-500 font-body text-sm w-28">利用開始</span>
            </dt>
            <dd class="flex min-w-0 flex-1 items-center text-sumi-900 font-body text-sm">2024年1月</dd>
          </div>
          <div class="flex items-center border-t min-h-14">
            <dt class="flex items-center">
              <span class="inline-flex w-7 items-center text-sumi-900 font-body">
               <PostIcon class="text-sumi-500" />
              </span>
              <span class="text-sumi-500 font-body text-sm w-28">投稿数</span>
            </dt>
            <dd class="flex items-center text-sumi-900 font-body text-sm">0</dd>
          </div>
        </dl>
      </div>
    </DashboardSection>

    <DashboardSection>
      <DashboardSectionHeader title="アクティビティ" />
      <SectionInfo text="投稿したらカレンダーに色がつきます。" class="text-sm font-body text-sumi-500 mt-3" />
    </DashboardSection>
  </DashboardContent>
</template>