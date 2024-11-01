<script setup lang="ts">
import { useStorageUrl } from '@/composables/useStorageUrl';
import NoContentImg from '@/views/atoms/noContentPlaceholderItems/NoContentImg.vue';
import NoContentHeading from '@/views/atoms/noContentPlaceholderItems/NoContentHeading.vue';
import NoContentPlaceholder from '@/views/atoms/noContentPlaceholderItems/NoContentPlaceholder.vue';

const { getStorageUrl } = useStorageUrl();

const message: string = `ようこそ、カレーの大冒険へ！
                        お気に入りのカレーをシェアしてカレー業界を盛り上げよう！`;
</script>

<template>
  <div class="flex w-full flex-col items-center justify-center py-16">
    <NoContentImg class="aspect-square w-52" :src="getStorageUrl('illust/everyone.svg')" />
    <NoContentHeading text="まだ投稿がありません。" />
    <NoContentPlaceholder class="text-center" :text="message" />
  </div>
</template>
