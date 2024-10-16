<script setup lang="ts">
import { ref } from 'vue';
import { useAccountStore } from '@/stores/account';
import { useRoute, onBeforeRouteUpdate } from 'vue-router';
import { useCommonStore } from '@/stores/common';
import type { Trash, PaginationStatus } from '@/types/trash';
import { useFetchTrashPosts } from '@/composables/functions/useFetchTrashPosts';
import { useRestorePost } from '@/composables/functions/useRestorePost';
import { useDeletePost } from '@/composables/functions/useDeletePost';
import TrashPagePlaceholder from '@/views/molecules/noContentPlaceholder/TrashPagePlaceholder.vue';
import TrashCard from '@/views/pages/Dashboard/Trash/components/TrashCard.vue';
import ActionConfirmModal from '@/views/molecules/modals/ActionConfirmModal.vue';
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue';

const accountStore = useAccountStore();
const commonStore = useCommonStore();
const route = useRoute();
const { fetchTrashPostsList } = useFetchTrashPosts();
const { restorePost } = useRestorePost();
const { hardDeletePost } = useDeletePost();

const posts = ref<Trash[]>([]);
const paginationStatus = ref<PaginationStatus | null>(null);
const open = ref<boolean>(false);
const selectedPostSlug = ref<string | null>(null);
const selectedAction = ref<'restore' | 'delete' | null>(null);

async function loadPosts(page: number = 1, userId: number, forceReload: boolean = false) {
  if (
    forceReload ||
    !paginationStatus.value ||
    page !== paginationStatus.value.current_page ||
    posts.value.length === 0
  ) {
    try {
      const { data, meta } = await fetchTrashPostsList({ page, userId });
      posts.value = data;
      paginationStatus.value = meta;
    } catch (error) {
      console.error('投稿の読み込みに失敗しました。:', error);
    }
  }
}

await loadPosts(Number(route.query.page) || 1, accountStore.state.user_id as number);

onBeforeRouteUpdate(async (to): Promise<void> => {
  const page = Number(to.query.page) || 1;
  await loadPosts(page, accountStore.state.user_id as number);
});

function openModal(slug: string, action: 'restore' | 'delete'): void {
  selectedPostSlug.value = slug;
  selectedAction.value = action;
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  open.value = false;
  selectedAction.value = null;
  document.body.style.overflow = 'auto';
}

async function doHardDelete() {
  if (!selectedPostSlug.value) return;

  try {
    commonStore.startApiLoading();
    const response = await hardDeletePost(selectedPostSlug.value);
    if (response.status === 200) {
      closeModal();
      posts.value = posts.value.filter((post) => post.slug !== selectedPostSlug.value);
      commonStore.setFlashMessage('投稿を削除しました');
      setTimeout(() => {
        commonStore.clearFlashMessage();
      }, 4000);
    } else {
      throw new Error(response.data.message);
    }
  } catch (error) {
    closeModal();
    commonStore.setErrorMessage('削除に失敗しました');
    setTimeout(() => {
      commonStore.clearErrorMessage();
    }, 4000);
  } finally {
    commonStore.stopApiLoading();
  }
}

async function doRestore() {
  if (!selectedPostSlug.value) return;

  try {
    commonStore.startApiLoading();
    const response = await restorePost(selectedPostSlug.value);
    if (response.status === 200) {
      closeModal();
      posts.value = posts.value.filter((post) => post.slug !== selectedPostSlug.value);
      commonStore.setFlashMessage('投稿を復元しました');
      setTimeout(() => {
        commonStore.clearFlashMessage();
      }, 4000);
    } else {
      throw new Error(response.data.message);
    }
  } catch (error) {
    closeModal();
    console.error('復元に失敗しました:', error);
    commonStore.setErrorMessage('復元に失敗しました');
    setTimeout(() => {
      commonStore.clearErrorMessage();
    }, 4000);
  } finally {
    commonStore.stopApiLoading();
  }
}
</script>
<template>
  <div class="grid grid-cols-1 gap-10" v-if="posts.length">
    <p class="font-body text-sm text-utility">
      ごみ箱に入れて30日を経過した投稿は自動で削除されます。
    </p>
    <TrashCard
      v-for="post in posts"
      :key="post.id"
      :src="post.post_img"
      :store-name="post.store_name"
      :comment="post.comment || '一言感想はありません。'"
      :deleted-at="post.deleted_at"
      @delete="openModal(post.slug as string, 'delete')"
      @restore="openModal(post.slug as string, 'restore')"
    />
  </div>

  <TrashPagePlaceholder v-else />

  <Teleport to="body">
    <ActionConfirmModal
      v-show="open && selectedAction === 'restore'"
      :is-loading="commonStore.state.apiLoading"
      modal-title="元に戻しますか？"
      modal-content="投稿を復元しようとしています。"
      button-text="元に戻す"
      @commit="doRestore"
      @cancel="closeModal"
      :closeModal="closeModal"
    />
    <DeleteConfirmModal
      v-show="open && selectedAction === 'delete'"
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
