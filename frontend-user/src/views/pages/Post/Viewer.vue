<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { usePostFormStore } from '@/stores/post_form'
import BackToHomeLink from '@/views/molecules/links/BackToHomeLink.vue'
import EditPostLink from '@/views/molecules/links/EditPostLink.vue'

import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue'
import PostDateBrowseItem from '@/views/molecules/browseItems/PostDateBrowseItem.vue'
import PostUserProfileLink from '@/views/molecules/links/PostUserProfileLink.vue'

const router = useRouter()
const postFormStore = usePostFormStore()

const postData = computed(() => postFormStore.state)

function load(): void {
  postFormStore.load(router.currentRoute.value.params.id as string)
}

onMounted(() => {
  load()
})
</script>
<template>
  <div class="flex items-center justify-between h-12 lg:sticky lg:top-0">
    <BackToHomeLink />
    <div class="flex items-center gap-2">
      <EditPostLink />
      <TrashIcon />
    </div>
  </div>
  <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md">
    <div class="pt-8">
      <div class="flex gap-2.5">
        <StoreIcon />
        <h1 class="font-body text-sumi-900 leading-relaxed text-xl">{{ postData.store_name }}</h1>
      </div>
      <div class="mt-20 flex items-center text-sumi-600 gap-3">
        <PostUserProfileLink />
        <span>&brvbar;</span>
        <PostDateBrowseItem class="text-base" :date="postData.posted_at" />
      </div>
    </div>

    <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md mt-9">
      <article>
        <img :src="postData.post_img" class="w-full object-cover" alt="投稿画像" />
        <div class="my-12 font-body text-sumi-900 leading-relaxed">
          <p v-if="postData.comment">{{ postData.comment }}</p>
          <p v-else>一言感想はありません。</p>
        </div>
      </article>
    </div>
  </div>
</template>
