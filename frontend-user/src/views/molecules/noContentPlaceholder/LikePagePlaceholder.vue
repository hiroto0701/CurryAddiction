<script setup lang="ts">
import NoContentImg from '@/views/atoms/noContentPlaceholderItems/NoContentImg.vue';
import NoContentHeading from '@/views/atoms/noContentPlaceholderItems/NoContentHeading.vue';
import NoContentPlaceholder from '@/views/atoms/noContentPlaceholderItems/NoContentPlaceholder.vue';
</script>
<template>
  <div class="flex w-full flex-col items-center justify-center py-16">
    <NoContentImg
      class="aspect-square w-52"
      src="http://localhost:9000/local-curry_addiction/illust/super-hungry-man-with-curry.svg"
    />
    <NoContentHeading text="いいね！した投稿がありません。" />
    <NoContentPlaceholder text="気になるカレーをいいね！して自分だけのお気に入りを完成させよう！" />
  </div>
</template>
