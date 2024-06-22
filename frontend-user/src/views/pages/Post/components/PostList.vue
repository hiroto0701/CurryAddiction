<script setup lang="ts">
import { ref } from 'vue'
import { useRoute, useRouter, onBeforeRouteUpdate } from 'vue-router'
import type { Post, PaginationStatus } from '@/composables/types/post'
import { useFetchPosts } from '@/composables/functions/useFetchPosts'
import Card from '@/views/molecules/card/Card.vue'
import Pagination from '@/views/molecules/Pagination.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'

const { fetchPostsList } = useFetchPosts()
const route = useRoute()
const router = useRouter()

const posts = ref<Post[]>([])
const paginationStatus = ref<PaginationStatus | null>(null)

async function loadPosts(page: number = 1) {
  if (
    !paginationStatus.value ||
    page !== paginationStatus.value.current_page ||
    posts.value.length === 0
  ) {
    try {
      const { data, meta } = await fetchPostsList({ page })
      posts.value = data
      paginationStatus.value = meta
    } catch (error) {
      console.error('Failed to load posts:', error)
    }
  }
}

await loadPosts(Number(route.query.page) || 1)

async function doChangePage(page: number | string): Promise<void> {
  await router.push({ query: { page: page.toString() } })
}

function toViewer(postId: string): void {
  router.push({ name: 'PostViewer', params: { id: postId } })
}

onBeforeRouteUpdate(async (to): Promise<void> => {
  const page = Number(to.query.page) || 1
  await loadPosts(page)
})
</script>
<template>
  <CardDisplayAreaLayout>
    <Card
      v-for="post in posts"
      :key="post.id"
      :src="post.post_img"
      :store-name="post.store_name"
      location="福岡市 中央区"
      :date="post.posted_at"
      @clickItem="toViewer(post.id)"
    />
  </CardDisplayAreaLayout>
  <Pagination class="mt-12" @change-page="doChangePage" :pagination-status="paginationStatus" />
</template>
