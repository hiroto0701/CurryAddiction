<script setup lang="ts">
import axios from 'axios';
import { ref, computed, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useCommonStore } from '@/stores/common';
import type { Post } from '@/types/post';
import { useFetchPostDetail } from '@/composables/functions/useFetchPostDetail';
import { useDeletePost } from '@/composables/functions/useDeletePost';
import BackLink from '@/views/molecules/links/BackLink.vue';
import PostUserProfileLink from '@/views/molecules/links/PostUserProfileLink.vue';
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue';
import GenreBrowseItem from '@/views/molecules/browseItems/GenreBrowseItem.vue';
import DateBrowseItem from '@/views/molecules/browseItems/DateBrowseItem.vue';
import PostImgBrowseItem from '@/views/molecules/browseItems/PostImgBrowseItem.vue';
import PostCommentBrowseItem from '@/views/molecules/browseItems/PostCommentBrowseItem.vue';
import PostLocationBrowseItem from '@/views/molecules/browseItems/PostLocationBrowseItem.vue';
import DeletePostButton from '@/views/molecules/buttons/DeletePostButton.vue';
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue';

const route = useRoute();
const router = useRouter();
const commonStore = useCommonStore();
const { fetchPostDetail } = useFetchPostDetail();
const { softDeletePost } = useDeletePost();
const post = ref<Post>({} as Post);
const isMine = computed((): boolean => post.value.is_mine);

const open = ref<boolean>(false);
function openModal(): void {
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  open.value = false;
  document.body.style.overflow = 'auto';
}

async function load(slug: string) {
  try {
    const data = await fetchPostDetail(slug);
    post.value = data;
  } catch (error) {
    console.error('投稿の読み込みに失敗しました:', error);
  }
}

await load(String(route.params.slug));

async function doSoftDelete(): Promise<void> {
  try {
    commonStore.startApiLoading();
    const response = await softDeletePost(String(route.params.slug));

    if (response.status === 200) {
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

watch(
  () => route.params.slug,
  async (newSlug) => {
    if (newSlug) {
      await load(newSlug as string);
    }
  }
);
</script>
<template>
  <div class="flex h-12 items-center justify-between lg:sticky lg:top-0">
    <BackLink />
    <div v-if="isMine" class="flex items-center gap-2">
      <DeletePostButton @delete="openModal" text="ごみ箱に入れる" />
    </div>
  </div>
  <div class="xs:px-7 mx-auto w-full max-w-screen-md px-6 sm:px-10">
    <div class="pt-4 md:pt-8">
      <div class="flex gap-2.5">
        <StoreNameBrowseItem
          class="w-full max-w-screen-md px-3 py-1 text-lg text-sumi-900 md:text-xl"
          :store-name="post.store_name"
        />
      </div>
      <div class="mt-2 flex gap-2.5">
        <GenreBrowseItem
          class="w-fit max-w-screen-md px-3 py-1 text-lg text-sumi-900 md:text-xl"
          :genre-id="post.genre_id"
        />
      </div>
      <div class="mt-20 flex max-w-2xl items-center justify-start gap-3 text-sumi-600">
        <PostUserProfileLink
          class="text-md min-w-0 flex-shrink truncate"
          :display-name="post.user.display_name"
          :handle-name="post.user.handle_name"
          :avatar-url="post.user.avatar_url"
        />
        <span class="flex-shrink-0">&brvbar;</span>
        <DateBrowseItem
          class="flex-shrink-0 whitespace-nowrap py-1 pr-2 text-base"
          :date="post.posted_at"
        />
      </div>
    </div>

    <div class="xs:px-7 mx-auto mt-9 w-full max-w-screen-md sm:px-10">
      <article>
        <PostImgBrowseItem :post-img="post.post_img" class="w-full object-cover" />
        <PostCommentBrowseItem
          :comment="post.comment"
          class="mt-12 max-w-screen-md break-all border-b border-dashed border-gray-300 pb-6"
        />
        <PostLocationBrowseItem
          class="mb-12 mt-6 max-w-screen-md"
          :store-name="post.store_name"
          :latitude="Number(post.latitude)"
          :longitude="Number(post.longitude)"
        />
      </article>
    </div>
  </div>

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
