<script setup lang="ts">
import { useStorageUrl } from '@/composables/useStorageUrl';
import NoContentImg from '@/views/atoms/noContentPlaceholderItems/NoContentImg.vue';
import NoContentHeading from '@/views/atoms/noContentPlaceholderItems/NoContentHeading.vue';
import NoContentPlaceholder from '@/views/atoms/noContentPlaceholderItems/NoContentPlaceholder.vue';

const { getStorageUrl } = useStorageUrl();
</script>

<template>
  <div class="flex w-full flex-col items-center justify-center py-16">
    <NoContentImg
      class="aspect-square w-52"
      :src="getStorageUrl('/illust/ok-woman-with-the-bowl.svg')"
    />
    <NoContentHeading text="ごみ箱に入れた投稿がありません。" />
    <NoContentPlaceholder text="ごみ箱に入れた投稿が表示されます。" />
  </div>
</template>
