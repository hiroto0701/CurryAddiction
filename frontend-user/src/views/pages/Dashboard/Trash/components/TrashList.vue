<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useRoute, onBeforeRouteUpdate } from 'vue-router'
import { useCommonStore } from '@/stores/common'
import { useDeletePost } from '@/composables/functions/useDeletePost'
import type { Trash, PaginationStatus } from '@/composables/types/trash'
import { useFetchTrashPosts } from '@/composables/functions/useFetchTrashPosts'
import TrashCard from '@/views/pages/Dashboard/Trash/components/TrashCard.vue'
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue'

const accountStore = useAccountStore()
const commonStore = useCommonStore()
const route = useRoute()
const { fetchTrashPostsList } = useFetchTrashPosts()
const { hardDeletePost } = useDeletePost()

const posts = ref<Trash[]>([])
const paginationStatus = ref<PaginationStatus | null>(null)
const open = ref<boolean>(false)
const selectedPostId = ref<number | null>(null)

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

function openModal(postId: number): void {
  selectedPostId.value = postId
  open.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  open.value = false
  document.body.style.overflow = 'auto'
}

async function doHardDelete() {
  if (!selectedPostId.value) return

  try {
    commonStore.startApiLoading()
    const response = await hardDeletePost(selectedPostId.value)
    if (response.status === 200) {
      closeModal()
      posts.value = posts.value.filter((post) => post.id !== selectedPostId.value)
      commonStore.setFlashMessage('投稿を削除しました')
      setTimeout(() => {
        commonStore.clearFlashMessage()
      }, 4000)
    } else {
      throw new Error(response.data.message)
    }
  } catch (error) {
    closeModal()
    console.error('Failed to delete the post:', error)
    commonStore.setErrorMessage('削除に失敗しました')
    setTimeout(() => {
      commonStore.clearErrorMessage()
    }, 4000)
  } finally {
    commonStore.stopApiLoading()
  }
}

function restorePost(postId: number) {
  console.log(postId)
}
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
      @delete="openModal(post.id)"
      @restore="restorePost(post.id)"
    />
  </div>

  <Teleport to="body">
    <DeleteConfirmModal
      v-show="open"
      :is-loading="commonStore.state.apiLoading"
      modal-title="完全に削除しますか？"
      modal-content="削除した投稿は復元できません。"
      button-text="削除する"
      @delete="doHardDelete"
      @cancel="closeModal"
      :closeModal="closeModal"
    />
  </Teleport>
</template>
