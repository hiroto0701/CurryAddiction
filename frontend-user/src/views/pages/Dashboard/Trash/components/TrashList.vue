<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useRoute, onBeforeRouteUpdate } from 'vue-router'
import type { Trash, PaginationStatus } from '@/composables/types/trash'
import { useFetchTrashPosts } from '@/composables/functions/useFetchTrashPosts'
import TrashCard from '@/views/pages/Dashboard/Trash/components/TrashCard.vue'

const accountStore = useAccountStore()
const route = useRoute()
const { fetchTrashPostsList } = useFetchTrashPosts()

const posts = ref<Trash[]>([])
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
  <div class="grid grid-cols-1 gap-10">
    <TrashCard
      v-for="post in posts"
      :key="post.id"
      :src="post.post_img"
      :store-name="post.store_name"
      :comment="post.comment || '一言感想はありません。'"
      :deleted-at="post.deleted_at"
    />
  </div>
</template>
