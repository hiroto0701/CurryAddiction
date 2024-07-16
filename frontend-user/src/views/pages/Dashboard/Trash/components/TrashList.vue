<script setup lang="ts">
import { ref } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useRoute, onBeforeRouteUpdate } from 'vue-router'
import { useCommonStore } from '@/stores/common'
import type { Trash, PaginationStatus } from '@/composables/types/trash'
import { useFetchTrashPosts } from '@/composables/functions/useFetchTrashPosts'
import { useRestorePost } from '@/composables/functions/useRestorePost'
import { useDeletePost } from '@/composables/functions/useDeletePost'
import TrashCard from '@/views/pages/Dashboard/Trash/components/TrashCard.vue'
import ActionConfirmModal from '@/views/molecules/modals/ActionConfirmModal.vue'
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue'

const accountStore = useAccountStore()
const commonStore = useCommonStore()
const route = useRoute()
const { fetchTrashPostsList } = useFetchTrashPosts()
const { restorePost } = useRestorePost()
const { hardDeletePost } = useDeletePost()

const posts = ref<Trash[]>([])
const paginationStatus = ref<PaginationStatus | null>(null)
const open = ref<boolean>(false)
const selectedPostId = ref<number | null>(null)
const selectedAction = ref<'restore' | 'delete' | null>(null)

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

function openModal(postId: number, action: 'restore' | 'delete'): void {
  selectedPostId.value = postId
  selectedAction.value = action
  open.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  open.value = false
  selectedAction.value = null
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
    commonStore.setErrorMessage('削除に失敗しました')
    setTimeout(() => {
      commonStore.clearErrorMessage()
    }, 4000)
  } finally {
    commonStore.stopApiLoading()
  }
}

async function doRestore() {
  if (!selectedPostId.value) return

  try {
    commonStore.startApiLoading()
    const response = await restorePost(selectedPostId.value)
    if (response.status === 200) {
      closeModal()
      posts.value = posts.value.filter((post) => post.id !== selectedPostId.value)
      commonStore.setFlashMessage('投稿を復元しました')
      setTimeout(() => {
        commonStore.clearFlashMessage()
      }, 4000)
    } else {
      throw new Error(response.data.message)
    }
  } catch (error) {
    closeModal()
    console.error('Failed to restore the post:', error)
    commonStore.setErrorMessage('復元に失敗しました')
    setTimeout(() => {
      commonStore.clearErrorMessage()
    }, 4000)
  } finally {
    commonStore.stopApiLoading()
  }
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
      @delete="openModal(post.id, 'delete')"
      @restore="openModal(post.id, 'restore')"
    />
  </div>

  <Teleport to="body">
    <ActionConfirmModal
      v-if="open && selectedAction === 'restore'"
      :is-loading="commonStore.state.apiLoading"
      modal-title="元に戻しますか？"
      modal-content="投稿を復元しようとしています。"
      button-text="元に戻す"
      @commit="doRestore"
      @cancel="closeModal"
      :closeModal="closeModal"
    />
    <DeleteConfirmModal
      v-if="open && selectedAction === 'delete'"
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
