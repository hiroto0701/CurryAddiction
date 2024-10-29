<script setup lang="ts">
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue';
import PostCommentBrowseItem from '@/views/molecules/browseItems/PostCommentBrowseItem.vue';

interface Props {
  readonly storeName: string;
  readonly src: string;
  readonly comment?: string;
}

defineProps<Props>();
</script>

<template>
  <div class="select-none opacity-80">
    <aside
      class="mx-auto overflow-hidden rounded-lg border border-gray-200"
      style="width: 90px; height: 110px"
    >
      <div
        class="pointer-events-none origin-top-left select-none"
        style="transform: scale(0.18, 0.18)"
      >
        <div class="p-14" style="width: 500px">
          <StoreNameBrowseItem :store-name />
          <div class="mt-14 max-w-screen-md break-all">
            <img :src width="1080" height="720" alt="ごみ箱内の投稿の画像" />
            <PostCommentBrowseItem class="mt-10 max-w-screen-md text-sm" :comment />
          </div>
        </div>
      </div>
    </aside>
  </div>
</template>
