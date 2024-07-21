<script setup lang="ts">
import NoContentHeading from '@/views/atoms/noContentPlaceholderItems/NoContentHeading.vue'
import NoContentPlaceholder from '@/views/atoms/noContentPlaceholderItems/NoContentPlaceholder.vue'
</script>
<template>
  <div class="w-full flex flex-col items-center justify-center py-16">
    <img class="w-52 aspect-square" src="../../../assets/a-woman-with-curry.svg" alt="" />
    <NoContentHeading text="保存した投稿がありません。" />
    <NoContentPlaceholder text="気になるカレーを保存して自分だけのコレクションを完成させよう！" />
  </div>
</template>
