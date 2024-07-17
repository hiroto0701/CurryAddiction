<script setup lang="ts">
import { ref, type Ref, inject, watch } from 'vue'
import { useRoute, useRouter, onBeforeRouteUpdate } from 'vue-router'
import { useCommonStore } from '@/stores/common'
import type { Post, PaginationStatus } from '@/composables/types/post'
import type { ServiceUser } from '@/composables/types/serviceUser'
import { useFetchPosts } from '@/composables/functions/useFetchPosts'
import { useLikePost } from '@/composables/functions/useLikePost'
import Card from '@/views/molecules/card/Card.vue'
import Pagination from '@/views/molecules/Pagination.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'

const commonStore = useCommonStore()
const { fetchPostsList } = useFetchPosts()
const { likePost } = useLikePost()
const route = useRoute()
const router = useRouter()

const posts = ref<Post[]>([])
const paginationStatus = ref<PaginationStatus | null>(null)

const pageUser = inject<Ref<ServiceUser | null>>('pageUser', ref(null))

async function loadPosts(
  page: number = 1,
  userId?: number,
  forceReload: boolean = false,
  isLiked: boolean = true
) {
  if (
    forceReload ||
    !paginationStatus.value ||
    page !== paginationStatus.value.current_page ||
    posts.value.length === 0
  ) {
    try {
      const { data, meta } = await fetchPostsList({ page, userId, isLiked })
      posts.value = data
      paginationStatus.value = meta
    } catch (error) {
      console.error('投稿の読み込みに失敗しました。:', error)
    }
  }
}

await loadPosts(Number(route.query.page) || 1, pageUser.value?.user_id)

async function doChangePage(page: number | string): Promise<void> {
  await router.push({ query: { page: page.toString() } })
}

function toViewer(postId: number): void {
  router.push({ name: 'PostViewer', params: { id: postId } })
}

// いいね一覧ページではいいねした投稿のみ取得
// =>いいねの解除のみ可能
async function removeLike(postId: number): Promise<void> {
  try {
    const response = await likePost(postId)
    if (response.status === 200) {
      posts.value = posts.value.filter((post) => post.id !== postId)

      // ページネーションの総数を更新
      if (paginationStatus.value && paginationStatus.value.total) {
        paginationStatus.value.total -= 1
      }

      // 現在のページの投稿が0になった場合、前のページに戻る
      if (
        posts.value.length === 0 &&
        paginationStatus.value &&
        paginationStatus.value.current_page &&
        paginationStatus.value.current_page > 1
      ) {
        await doChangePage(paginationStatus.value.current_page - 1)
      }
    }
  } catch (error) {
    commonStore.setErrorMessage('いいねできませんでした')
    setTimeout(() => {
      commonStore.clearErrorMessage()
    }, 4000)
  }
}

async function toggleArchive(postId: number): Promise<void> {
  console.log(postId)
}

onBeforeRouteUpdate(async (to): Promise<void> => {
  const page = Number(to.query.page) || 1
  await loadPosts(page, pageUser.value?.user_id)
})

watch(
  pageUser,
  async (newUser) => {
    if (newUser) {
      await loadPosts(Number(route.query.page) || 1, pageUser.value?.user_id, true)
    }
  },
  { deep: true }
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
      :is-liked="post.current_user_liked"
      :is-archived="false"
      @clickItem="toViewer(post.id)"
      @like="removeLike(post.id)"
      @archive="toggleArchive(post.id)"
    />
  </CardDisplayAreaLayout>
  <Pagination class="mt-12" @change-page="doChangePage" :pagination-status="paginationStatus" />
</template>
