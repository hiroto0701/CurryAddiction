<script setup lang="ts">
import NoContentHeading from '@/views/atoms/noContentPlaceholderItems/NoContentHeading.vue'
import NoContentPlaceholder from '@/views/atoms/noContentPlaceholderItems/NoContentPlaceholder.vue'
</script>
<template>
  <div class="w-full flex flex-col items-center justify-center py-16">
    <img class="w-52 aspect-square" src="../../../assets/a-woman-eating.svg" alt="" />
    <NoContentHeading text="いいね！した投稿がありません。" />
    <NoContentPlaceholder text="気になるカレーをいいね！して自分だけのお気に入りを完成させよう！" />
  </div>
</template>
