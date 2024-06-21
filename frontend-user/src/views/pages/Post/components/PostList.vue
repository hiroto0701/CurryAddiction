<script setup lang="ts">
import { ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { usePosts, type Post } from '@/composables/useFetchPostData'
import Card from '@/views/molecules/card/Card.vue'
import Pagination from '@/views/molecules/Pagination.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'

const posts = ref<Post[]>([])
const { paginationStatus, fetchPostsList, setCurrentPage } = usePosts()
const route = useRoute()
const router = useRouter()

async function loadPosts(page: number = 1) {
  try {
    const data = await fetchPostsList({ page })
    posts.value = data.data
  } catch (error) {
    console.error('Failed to load posts:', error)
  }
}

await loadPosts(Number(route.query.page) || 1)

async function doChangePage(page: number): Promise<void> {
  await setCurrentPage(page)
  await loadPosts(page)
}

function toViewer(postId: string) {
  router.push({ name: 'PostViewer', params: { id: postId } })
}

watch(
  () => route.query.page,
  async (newPage) => {
    const page = newPage ? parseInt(newPage as string, 10) : 1
    await loadPosts(page)
  }
)
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
