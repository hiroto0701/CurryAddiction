<script setup lang="ts">
import axios from 'axios'
import { ref, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useCommonStore } from '@/stores/common'
import type { Post } from '@/composables/types/post'
import { useFetchPostDetail } from '@/composables/functions/useFetchPostDetail'
import { useDeletePost } from '@/composables/functions/useDeletePost'
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'
import BackToHomeLink from '@/views/molecules/links/BackToHomeLink.vue'
import EditPostLink from '@/views/molecules/links/EditPostLink.vue'
import PostUserProfileLink from '@/views/molecules/links/PostUserProfileLink.vue'
import PostDateBrowseItem from '@/views/molecules/browseItems/PostDateBrowseItem.vue'
import SoftDeletePostButton from '@/views/molecules/buttons/SoftDeletePostButton.vue'
import PostSoftDeleteConfirmModal from '@/views/molecules/modals/PostSoftDeleteConfirmModal.vue'

const route = useRoute()
const router = useRouter()
const commonStore = useCommonStore()
const { fetchPostDetail } = useFetchPostDetail()
const { softDeletePost } = useDeletePost()
const post = ref<Post>({} as Post)
const isMine = computed((): boolean => post.value.is_mine)

async function load(postId: string) {
  try {
    const data = await fetchPostDetail(postId)
    post.value = data
  } catch (error) {
    console.error('Failed to load posts:', error)
  }
}

await load(route.params.id as string)

const open = ref<boolean>(false)
function openModal(): void {
  open.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  open.value = false
  document.body.style.overflow = 'auto'
}

async function doSoftDelete() {
  try {
    commonStore.startApiLoading()
    const response = await softDeletePost(route.params.id as string)

    if (response.status === 200) {
      closeModal()
      await router.push({ name: 'Home' }).then((): void => {
        commonStore.setFlashMessage('投稿をごみ箱に入れました')
        setTimeout(() => {
          commonStore.clearFlashMessage()
        }, 4000)
      })
    } else {
      throw new Error(response.data.message)
    }
  } catch (error) {
    console.error('Failed to delete the post:', error)
    if (axios.isAxiosError(error)) {
      console.log(`削除に失敗しました: ${error.response?.data?.message || error.message}`, error)
    } else {
      console.log('予期せぬエラーが発生しました', error)
    }
  } finally {
    commonStore.stopApiLoading()
  }
}
</script>
<template>
  <div class="flex items-center justify-between h-12 lg:sticky lg:top-0">
    <BackToHomeLink />
    <div v-if="isMine" class="flex items-center gap-2">
      <EditPostLink />
      <SoftDeletePostButton @soft-delete="openModal" />
    </div>
  </div>
  <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md">
    <div class="pt-8">
      <div class="flex gap-2.5">
        <StoreIcon />
        <h1 class="font-body text-sumi-900 leading-relaxed text-xl">{{ post.store_name }}</h1>
      </div>
      <div class="mt-20 flex items-center text-sumi-600 gap-3">
        <PostUserProfileLink
          :display-name="post.user.display_name"
          :handle-name="post.user.handle_name"
          :avatar-url="post.user.avatar_url"
        />
        <span>&brvbar;</span>
        <PostDateBrowseItem class="text-base" :date="post.posted_at" />
      </div>
    </div>

    <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md mt-9">
      <article>
        <img :src="post.post_img" class="w-full object-cover" alt="投稿画像" />
        <div class="my-12 font-body text-sumi-900 leading-relaxed">
          <p v-if="post.comment">{{ post.comment }}</p>
          <p v-else>一言感想はありません。</p>
        </div>
      </article>
    </div>
  </div>

  <Teleport to="body">
    <PostSoftDeleteConfirmModal
      v-show="open"
      :is-loading="commonStore.state.apiLoading"
      @delete="doSoftDelete"
      @cancel="closeModal"
      :closeModal="closeModal"
    />
  </Teleport>
</template>
