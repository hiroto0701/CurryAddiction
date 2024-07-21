<script setup lang="ts">
import NoContentHeading from '@/views/atoms/noContentPlaceholderItems/NoContentHeading.vue'
import NoContentPlaceholder from '@/views/atoms/noContentPlaceholderItems/NoContentPlaceholder.vue'
</script>
<template>
  <div class="w-full flex flex-col items-center justify-center py-16">
    <img class="w-52 aspect-square" src="../../../assets/a-ok-woman.svg" alt="" />
    <NoContentHeading text="ごみ箱に入れた投稿がありません。" />
    <NoContentPlaceholder text="ごみ箱に入れた投稿が表示されます。" />
  </div>
</template>
