<script setup lang="ts">
import PostCommentBrowseItem from '@/views/molecules/browseItems/PostCommentBrowseItem.vue'

interface Props {
  readonly storeName: string
  readonly src: string
  readonly comment?: string
}
defineProps<Props>()
</script>
<template>
  <div class="select-none opacity-75">
    <aside
      class="mx-auto overflow-hidden border border-gray-200 rounded-lg"
      style="width: 90px; height: 110px"
    >
      <div
        class="origin-top-left select-none pointer-events-none"
        style="transform: scale(0.18, 0.18)"
      >
        <div class="p-14" style="width: 500px">
          <h2 class="text-left text-xl">{{ storeName }}</h2>
          <div class="mt-14 text-2xs tracking-normal">
            <img :src width="1080" height="720" alt="ごみ箱ないの投稿の画像" />
            <PostCommentBrowseItem class="mt-10 text-sm" :comment />
          </div>
        </div>
      </div>
    </aside>
  </div>
</template>
