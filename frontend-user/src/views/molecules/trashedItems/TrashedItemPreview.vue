<script setup lang="ts">
import PostCommentBrowseItem from '@/views/molecules/browseItems/PostCommentBrowseItem.vue'
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
          <div class="text-left text-xl">タイトル</div>
          <div class="mt-14 text-2xs tracking-normal">
            <img
              src="https://static.sizu.me/api/resize-image/78792e1023ad?url=https%3A%2F%2Fr2.sizu.me%2Fusers%2F26946%2Fpost-images%2F07bcao88rzakxh76r7z9.jpeg&amp;width=200"
              width="1080"
              height="720"
              alt=""
            />
            <PostCommentBrowseItem class="mt-10 text-sm" comment="コメントを入れる場所だお" />
          </div>
        </div>
      </div>
    </aside>
  </div>
</template>
