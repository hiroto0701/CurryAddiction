<script setup lang="ts">
import CardImg from '@/views/atoms/CardImg.vue'
import CardBody from '@/views/molecules/card/CardBody.vue'
</script>
<template>
  <div class="h-80 rounded-lg overflow-hidden border border-gray-200">
    <div class="w-full h-52 cursor-pointer duration-300 hover:opacity-80">
      <CardImg :src="'https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg'" />
    </div>

    <CardBody store-name="和平カレー" location="福岡" date="2024年12月24日" />

  </div>
</template>