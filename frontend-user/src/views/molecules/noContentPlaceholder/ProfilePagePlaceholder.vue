<script setup lang="ts">
import NoContentHeading from '@/views/atoms/noContentPlaceholderItems/NoContentHeading.vue'
import NoContentPlaceholder from '@/views/atoms/noContentPlaceholderItems/NoContentPlaceholder.vue'
</script>
<template>
  <div class="w-full flex flex-col items-center justify-center py-16">
    <img class="w-52 aspect-square" src="../../../assets/a-man-eating.svg" alt="" />
    <NoContentHeading text="まだ投稿がありません。" />
    <NoContentPlaceholder
      text="たくさん投稿をしてみんなにおすすめのカレーを知ってもらいましょう。"
    />
  </div>
</template>
