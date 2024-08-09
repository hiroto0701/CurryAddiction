<script setup lang="ts">
import axios from 'axios';
import { ref, type Ref, inject, watch } from 'vue';
import { useRoute, useRouter, onBeforeRouteUpdate } from 'vue-router';
import { useCommonStore } from '@/stores/common';
import type { Post, PaginationStatus } from '@/composables/types/post';
import type { ServiceUser } from '@/composables/types/serviceUser';
import { useFetchPosts } from '@/composables/functions/useFetchPosts';
import { useLikePost } from '@/composables/functions/useLikePost';
import { useArchivePost } from '@/composables/functions/useArchivePost';
import { useDeletePost } from '@/composables/functions/useDeletePost';
import HomePagePlaceholder from '@/views/molecules/noContentPlaceholder/HomePagePlaceholder.vue';
import Card from '@/views/molecules/card/Card.vue';
import Pagination from '@/views/molecules/Pagination.vue';
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue';
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue';

const commonStore = useCommonStore();
const { fetchPostsList } = useFetchPosts();
const { likePost } = useLikePost();
const { archivePost } = useArchivePost();
const { softDeletePost } = useDeletePost();
const route = useRoute();
const router = useRouter();

const posts = ref<Post[]>([]);
const paginationStatus = ref<PaginationStatus | null>(null);

const pageUser = inject<Ref<ServiceUser | null>>('pageUser', ref(null));

const open = ref<boolean>(false);
const selectedPostId = ref<number | null>(null);

function openModal(postId: number): void {
  selectedPostId.value = postId;
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  selectedPostId.value = null;
  open.value = false;
  document.body.style.overflow = 'auto';
}

async function loadPosts(page: number = 1, userId?: number, forceReload: boolean = false) {
  if (
    forceReload ||
    !paginationStatus.value ||
    page !== paginationStatus.value.current_page ||
    posts.value.length === 0
  ) {
    try {
      const { data, meta } = await fetchPostsList({ page, userId });
      posts.value = data;
      paginationStatus.value = meta;
    } catch (error) {
      console.error('投稿の読み込みに失敗しました。:', error);
    }
  }
}

await loadPosts(Number(route.query.page) || 1, pageUser.value?.user_id);

async function doChangePage(page: number | string): Promise<void> {
  await router.push({ query: { page: page.toString() } });
}

function toViewer(postId: number): void {
  router.push({ name: 'PostViewer', params: { id: postId } });
}

async function toggleLike(postId: number): Promise<void> {
  try {
    const response = await likePost(postId);
    if (response.status === 200) {
      const postIndex = posts.value.findIndex((post) => post.id === postId);
      if (postIndex !== -1) {
        posts.value[postIndex].current_user_liked = !posts.value[postIndex].current_user_liked;
      }
    }
  } catch (error) {
    commonStore.setErrorMessage('いいねできませんでした');
    setTimeout(() => {
      commonStore.clearErrorMessage();
    }, 4000);
  }
}

async function toggleArchive(postId: number): Promise<void> {
  try {
    const response = await archivePost(postId);
    if (response.status === 200) {
      const postIndex = posts.value.findIndex((post) => post.id === postId);
      if (postIndex !== -1) {
        posts.value[postIndex].current_user_archived =
          !posts.value[postIndex].current_user_archived;
      }
    }
  } catch (error) {
    commonStore.setErrorMessage('保存できませんでした');
    setTimeout(() => {
      commonStore.clearErrorMessage();
    }, 4000);
  }
}

async function doSoftDelete(): Promise<void> {
  if (selectedPostId.value === null) return;

  try {
    commonStore.startApiLoading();
    const response = await softDeletePost(selectedPostId.value);

    if (response.status === 200) {
      posts.value = posts.value.filter((post) => post.id !== selectedPostId.value);
      closeModal();
      await router.push({ name: 'Home' }).then((): void => {
        commonStore.setFlashMessage('ごみ箱に入れました');
        setTimeout(() => {
          commonStore.clearFlashMessage();
        }, 4000);
      });
    } else {
      throw new Error(response.data.message);
    }
  } catch (error) {
    console.error('Failed to delete the post:', error);
    if (axios.isAxiosError(error)) {
      console.log(`削除に失敗しました: ${error.response?.data?.message || error.message}`, error);
    } else {
      console.log('予期せぬエラーが発生しました', error);
    }
  } finally {
    commonStore.stopApiLoading();
  }
}

onBeforeRouteUpdate(async (to): Promise<void> => {
  const page = Number(to.query.page) || 1;
  await loadPosts(page, pageUser.value?.user_id);
});

watch(
  pageUser,
  async (newUser) => {
    if (newUser) {
      await loadPosts(Number(route.query.page) || 1, pageUser.value?.user_id, true);
    }
  },
  { deep: true }
);
</script>
<template>
  <div v-if="posts.length">
    <CardDisplayAreaLayout>
      <Card
        v-for="post in posts"
        :key="post.id"
        :src="post.post_img"
        :store-name="post.store_name"
        location="福岡市 中央区"
        :date="post.posted_at"
        :display-name="post.user.display_name"
        :handle-name="post.user.handle_name"
        :avatar-url="post.user.avatar_url"
        :is-liked="post.current_user_liked"
        :is-archived="post.current_user_archived"
        :is-mine="post.is_mine"
        @navigate-to-detail="toViewer(post.id)"
        @like="toggleLike(post.id)"
        @archive="toggleArchive(post.id)"
        @handle-post="openModal(post.id)"
      />
    </CardDisplayAreaLayout>
    <Pagination class="mt-12" @change-page="doChangePage" :pagination-status="paginationStatus" />
  </div>
  <HomePagePlaceholder v-else />

  <Teleport to="body">
    <DeleteConfirmModal
      v-show="open"
      :is-loading="commonStore.state.apiLoading"
      modal-title="ごみ箱に入れますか？"
      modal-content="ごみ箱の投稿は30日後に完全に削除されます。"
      button-text="ごみ箱に入れる"
      @delete="doSoftDelete"
      @cancel="closeModal"
      :closeModal="closeModal"
    />
  </Teleport>
</template>
