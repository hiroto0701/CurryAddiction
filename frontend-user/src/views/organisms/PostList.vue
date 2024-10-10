<script setup lang="ts">
import axios from 'axios';
import { ref, inject, watch, type Ref, type Component } from 'vue';
import { useRoute, useRouter, onBeforeRouteUpdate } from 'vue-router';
import { useAccountStore } from '@/stores/account';
import { useCommonStore } from '@/stores/common';
import type { Post, PaginationStatus } from '@/types/post';
import type { ServiceUser } from '@/types/serviceUser';
import { useFetchPosts } from '@/composables/functions/useFetchPosts';
import { useLikePost } from '@/composables/functions/useLikePost';
import { useArchivePost } from '@/composables/functions/useArchivePost';
import { useDeletePost } from '@/composables/functions/useDeletePost';
import Card from '@/views/molecules/card/Card.vue';
import Pagination from '@/views/molecules/Pagination.vue';
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue';
import PostFilterSideBar from '@/views/organisms/PostFilterSideBar.vue';
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue';

interface Props {
  readonly placeholderComponent: null | Component;
  readonly pageType: String;
}
const props = defineProps<Props>();

const accountStore = useAccountStore();
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
const selectedPostSlug = ref<string | null>(null);

function openModal(slug: string): void {
  selectedPostSlug.value = slug;
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  selectedPostSlug.value = null;
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
      const params = new URLSearchParams();
      params.append('page', page.toString());
      if (userId) params.append('userId', userId.toString());

      // いいねページの場合はパラメータにいいねの情報を付与
      if (props.pageType === 'like') params.append('isLiked', 'true');

      // アーカイブページの場合はパラメータにアーカイブの情報を付与
      if (props.pageType === 'archive') params.append('isArchived', 'true');

      // 一覧ページ（Home）の場合はお気に入りジャンル情報を付与
      if (props.pageType === 'home') {
        const favoriteGenres = accountStore.state.favorite_genres.map((fg) => fg.genre_id);
        favoriteGenres.forEach((genreId) => {
          params.append('favorite_genres[]', genreId.toString());
        });
      }

      const { data, meta } = await fetchPostsList(params);
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

function toViewer(slug: string): void {
  router.push({ name: 'PostViewer', params: { slug } });
}

async function handleLike(postId: number): Promise<void> {
  try {
    const response = await likePost(postId);
    if (response.status === 200) {
      // いいね一覧ページではいいねした投稿のみ取得
      // =>いいねの解除のみ可能
      if (props.pageType === 'like') {
        removePost(postId);
      } else {
        const postIndex = posts.value.findIndex((post) => post.id === postId);
        if (postIndex !== -1) {
          posts.value[postIndex].current_user_liked = !posts.value[postIndex].current_user_liked;
        }
      }
    }
  } catch (error) {
    commonStore.setErrorMessage('いいねできませんでした');
    setTimeout(() => {
      commonStore.clearErrorMessage();
    }, 4000);
  }
}

async function handleArchive(postId: number): Promise<void> {
  try {
    const response = await archivePost(postId);
    if (response.status === 200) {
      // アーカイブ一覧ページではアーカイブした投稿のみ取得
      // =>アーカイブの解除のみ可能
      if (props.pageType === 'archive') {
        removePost(postId);
      } else {
        const postIndex = posts.value.findIndex((post) => post.id === postId);
        if (postIndex !== -1) {
          posts.value[postIndex].current_user_archived =
            !posts.value[postIndex].current_user_archived;
        }
      }
    }
  } catch (error) {
    commonStore.setErrorMessage('保存できませんでした');
    setTimeout(() => {
      commonStore.clearErrorMessage();
    }, 4000);
  }
}

function removePost(postId: number): void {
  posts.value = posts.value.filter((post) => post.id !== postId);

  // ページネーションの総数を更新
  if (paginationStatus.value && paginationStatus.value.total) {
    paginationStatus.value.total -= 1;
  }

  // 現在のページの投稿が0になった場合、前のページに戻る
  if (
    posts.value.length === 0 &&
    paginationStatus.value &&
    paginationStatus.value.current_page &&
    paginationStatus.value.current_page > 1
  ) {
    doChangePage(paginationStatus.value.current_page - 1);
  }
}

async function doSoftDelete(): Promise<void> {
  if (selectedPostSlug.value === null) return;

  try {
    commonStore.startApiLoading();
    const response = await softDeletePost(selectedPostSlug.value);

    if (response.status === 200) {
      posts.value = posts.value.filter((post) => post.slug !== selectedPostSlug.value);
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
    console.error('削除に失敗しました:', error);
    if (axios.isAxiosError(error)) {
      console.error(`削除に失敗しました: ${error.response?.data?.message || error.message}`, error);
    } else {
      console.error('予期せぬエラーが発生しました', error);
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
  <div class="relative w-full">
    <PostFilterSideBar
      v-if="pageType === 'home'"
      :favorite-genres="accountStore.state.favorite_genres"
    />
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
          @navigate-to-detail="toViewer(post.slug)"
          @like="handleLike(post.id)"
          @archive="handleArchive(post.id)"
          @handle-post="openModal(post.slug)"
        />
      </CardDisplayAreaLayout>
      <Pagination class="mt-12" @change-page="doChangePage" :paginationStatus />
    </div>

    <component :is="placeholderComponent" v-else />

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
  </div>
</template>
