<script setup lang="ts">
import Card from '@/views/molecules/card/Card.vue'
</script>
<template>
  <header class="flex items-center gap-3 text-xl text-main">
    <h1>いいねした投稿</h1>
  </header>
  <div class="mt-12 grid grid-cols-1 gap-x-7 gap-y-12 sm:grid-cols-2 md:grid-cols-3">
    <Card :src="'https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg'" store-name="和平カレー" location="福岡" date="2024年12月24日" />
    <Card :src="'https://livedoor.blogimg.jp/mantaro_club/imgs/e/a/eae0ac07.jpg'" store-name="ダメヤ" location="福岡" date="2024年12月24日" />
    <Card :src="'https://umaga.net/wp-content/uploads/2021/08/DSC02736-1200x798.jpg'" store-name="ヌワラエリヤ" location="福岡" date="2024年12月24日" />
    <Card :src="'https://umaga.net/wp-content/uploads/2021/08/DSC02736-1200x798.jpg'" store-name="ヌワラエリヤ" location="福岡" date="2024年12月24日" />
    <Card :src="'https://umaga.net/wp-content/uploads/2021/08/DSC02736-1200x798.jpg'" store-name="ヌワラエリヤ" location="福岡" date="2024年12月24日" />
  </div>
</template>