<script setup lang="ts">
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import Card from '@/views/molecules/card/Card.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'
</script>
<template>
  <DashboardContent title="いいねした投稿">
    <CardDisplayAreaLayout>
      <Card :src="'https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg'" store-name="和平カレー" location="福岡" date="2024年12月24日" />
      <Card :src="'https://livedoor.blogimg.jp/mantaro_club/imgs/e/a/eae0ac07.jpg'" store-name="ダメヤ" location="福岡" date="2024年12月24日" />
      <Card :src="'https://umaga.net/wp-content/uploads/2021/08/DSC02736-1200x798.jpg'" store-name="ヌワラエリヤ" location="福岡" date="2024年12月24日" />
      <Card :src="'https://umaga.net/wp-content/uploads/2021/08/DSC02736-1200x798.jpg'" store-name="ヌワラエリヤ" location="福岡" date="2024年12月24日" />
      <Card :src="'https://umaga.net/wp-content/uploads/2021/08/DSC02736-1200x798.jpg'" store-name="ヌワラエリヤ" location="福岡" date="2024年12月24日" />
    </CardDisplayAreaLayout>
  </DashboardContent>
</template>
