<script setup lang="ts">
import axios from 'axios'
import { ref, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useCommonStore } from '@/stores/common'
import type { Post } from '@/composables/types/post'
import { useFetchPostDetail } from '@/composables/functions/useFetchPostDetail'
import { useDeletePost } from '@/composables/functions/useDeletePost'
import BackLink from '@/views/molecules/links/BackLink.vue'
import PostUserProfileLink from '@/views/molecules/links/PostUserProfileLink.vue'
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue'
import PostDateBrowseItem from '@/views/molecules/browseItems/PostDateBrowseItem.vue'
import PostCommentBrowseItem from '@/views/molecules/browseItems/PostCommentBrowseItem.vue'
import DeletePostButton from '@/views/molecules/buttons/DeletePostButton.vue'
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue'

const route = useRoute()
const router = useRouter()
const commonStore = useCommonStore()
const { fetchPostDetail } = useFetchPostDetail()
const { softDeletePost } = useDeletePost()
const post = ref<Post>({} as Post)
const isMine = computed((): boolean => post.value.is_mine)

const open = ref<boolean>(false)
function openModal(): void {
  open.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  open.value = false
  document.body.style.overflow = 'auto'
}

async function load(postId: number) {
  try {
    const data = await fetchPostDetail(postId)
    post.value = data
  } catch (error) {
    console.error('Failed to load posts:', error)
  }
}

await load(Number(route.params.id))

async function doSoftDelete(): Promise<void> {
  try {
    commonStore.startApiLoading()
    const response = await softDeletePost(Number(route.params.id))

    if (response.status === 200) {
      closeModal()
      await router.push({ name: 'Home' }).then((): void => {
        commonStore.setFlashMessage('ごみ箱に入れました')
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
  <div class="flex h-12 items-center justify-between lg:sticky lg:top-0">
    <BackLink />
    <div v-if="isMine" class="flex items-center gap-2">
      <DeletePostButton @delete="openModal" text="ごみ箱に入れる" />
    </div>
  </div>
  <div class="xs:px-7 mx-auto w-full max-w-screen-md px-6 sm:px-10">
    <div class="pt-8">
      <div class="flex gap-2.5">
        <StoreNameBrowseItem
          class="w-full max-w-screen-md px-3 py-1 text-xl text-sumi-900"
          :store-name="post.store_name"
        />
      </div>
      <div class="mt-20 flex items-center gap-3 text-sumi-600">
        <PostUserProfileLink
          :display-name="post.user.display_name"
          :handle-name="post.user.handle_name"
          :avatar-url="post.user.avatar_url"
        />
        <span>&brvbar;</span>
        <PostDateBrowseItem class="text-base" :date="post.posted_at" />
      </div>
    </div>

    <div class="xs:px-7 mx-auto mt-9 w-full max-w-screen-md px-6 sm:px-10">
      <article>
        <img :src="post.post_img" class="w-full object-cover" alt="投稿画像" />
        <div class="my-12">
          <PostCommentBrowseItem v-if="post.comment" :comment="post.comment" />
          <PostCommentBrowseItem v-else comment="一言感想はありません。" />
        </div>
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
