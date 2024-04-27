<script setup lang="ts">
import { useAccountStore } from '@/stores/account'
import Card from '@/views/molecules/card/Card.vue'
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue'
import PostIcon from '@/views/atoms/icons/PostIcon.vue'
import CalenderIcon from '@/views/atoms/icons/CalenderIcon.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'

const accountStore = useAccountStore()
</script>
<template>
  <div class="mb-12 overflow-hidden rounded-2xl border p-6 md:p-7">
    <div class="flex items-center gap-3.5 py-6">
      <div class="aspect-square w-24">
        <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full">
      </div>
      <div class="flex-1 leading-normal">
        <DisplayNameBrowseItem :value="accountStore.state.display_name" class="break-all text-md text-sumi-900 font-body" />
        <span class="font-body mt-1 inline-flex text-sm text-sumi-500">curry-addiction/hiroto</span>
      </div>
      <span>
        <a class="inline-flex items-center justify-center duration-500 hover:opacity-70 hover:bg-slate-50 text-sumi-900 font-body border rounded-full text-xs py-2.5 px-3.5" href="/dashboard/settings">
          設定
        </a>
      </span>
    </div>
    <div>
      <dl class="leading-normal">
        <div class="flex items-center min-h-14">
          <dt class="flex items-center">
            <span class="inline-flex w-7 items-center text-sumi-500">
              <CalenderIcon class="text-sumi-500" />
            </span>
            <span class="font-body text-sumi-500 text-sm w-28">利用開始</span>
          </dt>
          <dd class="flex min-w-0 flex-1 items-center font-body text-sumi-900 text-sm">2024年1月</dd>
        </div>
        <div class="flex items-center border-t min-h-14">
          <dt class="flex items-center">
            <span class="inline-flex w-7 items-center text-sumi-500">
              <PostIcon class="text-sumi-500" />
            </span>
            <span class="font-body text-sumi-500 text-sm w-28">投稿数</span>
          </dt>
          <dd class="flex items-center font-body text-sumi-900 text-sm">0</dd>
        </div>
      </dl>
    </div>
  </div>
  <CardDisplayAreaLayout>
    <Card :src="'https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg'" store-name="和平カレー" location="福岡" date="2024年12月24日" />
    <Card :src="'https://livedoor.blogimg.jp/mantaro_club/imgs/e/a/eae0ac07.jpg'" store-name="ダメヤ" location="福岡" date="2024年12月24日" />
    <Card :src="'https://umaga.net/wp-content/uploads/2021/08/DSC02736-1200x798.jpg'" store-name="ヌワラエリヤ" location="福岡" date="2024年12月24日" />
    <Card :src="'https://img.rurubu.jp/img_srw/andmore/images/0000239745/yMJCHzJxBlvH94UqlUlXon7iIQyj6FZonEaXOitI.jpeg'" store-name="クボカリー" location="福岡" date="2024年12月24日" />
    <Card :src="'https://japanesecurry.net/spicy_cms/wp-content/uploads/2019/12/afterglow-520x390.jpg'" store-name="アフターグロウ" location="福岡" date="2024年12月24日" />
    <Card :src="'https://kbc.co.jp/up/content/15/52/f9d7a4913873066e0ec8713aa5fcb3180add5b38.jpg'" store-name="Rスリランカ" location="福岡" date="2024年12月24日" />
  </CardDisplayAreaLayout>
</template>
