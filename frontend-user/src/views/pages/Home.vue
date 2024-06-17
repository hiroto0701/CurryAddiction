<script setup lang="ts">
import { useRouter } from 'vue-router'
import { computed, onMounted } from 'vue'
import { usePostStore, type Post, type PaginationStatus } from '@/stores/post_index'
import Card from '@/views/molecules/card/Card.vue'
import Pagination from '@/views/molecules/Pagination.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'

const postStore = usePostStore()
const router = useRouter()

const posts = computed<Post[]>(() => {
  return postStore.posts
})

const paginationStatus = computed<PaginationStatus>(() => {
  return postStore.paginationStatus
})

function load(): void {
  postStore.load()
}

function doChangePage(page: number): void {
  postStore.setCurrentPage(page)
  load()
}

function toViewer(postId: string) {
  router.push({ name: 'PostViewer', params: { id: postId } })
}

onMounted((): void => {
  load()
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
  <Pagination class="mt-12" @change-page="doChangePage" :paginationStatus />
</template>
