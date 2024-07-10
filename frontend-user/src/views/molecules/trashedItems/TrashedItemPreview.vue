<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useRoute, onBeforeRouteUpdate } from 'vue-router'
import type { Post, PaginationStatus } from '@/composables/types/post'
import { useFetchTrashPosts } from '@/composables/functions/useFetchTrashPosts'
import PostCommentBrowseItem from '@/views/molecules/browseItems/PostCommentBrowseItem.vue'

const accountStore = useAccountStore()
const route = useRoute()
const { fetchTrashPostsList } = useFetchTrashPosts()

const posts = ref<Post[]>([])
const paginationStatus = ref<PaginationStatus | null>(null)

async function loadPosts(page: number = 1, userId: number, forceReload: boolean = false) {
  if (
    forceReload ||
    !paginationStatus.value ||
    page !== paginationStatus.value.current_page ||
    posts.value.length === 0
  ) {
    try {
      const { data, meta } = await fetchTrashPostsList({ page, userId })
      posts.value = data
      paginationStatus.value = meta

      console.log(posts.value)
    } catch (error) {
      console.error('Failed to load posts:', error)
    }
  }
}

await loadPosts(Number(route.query.page) || 1, accountStore.state.user_id as number)

onBeforeRouteUpdate(async (to): Promise<void> => {
  const page = Number(to.query.page) || 1
  await loadPosts(page, accountStore.state.user_id as number)
})
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
