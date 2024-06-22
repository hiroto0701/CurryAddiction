<script setup lang="ts">
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import type { Post } from '@/composables/types/post'
import { useFetchPostDetail } from '@/composables/functions/useFetchPostDetail'
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'
import PostDateBrowseItem from '@/views/molecules/browseItems/PostDateBrowseItem.vue'
import PostUserProfileLink from '@/views/molecules/links/PostUserProfileLink.vue'

const route = useRoute()
const { fetchPostDetail } = useFetchPostDetail()

const post = ref<Post | null>(null)

async function load(param: string) {
  try {
    const data = await fetchPostDetail(param)
    post.value = data
  } catch (error) {
    console.error('Failed to load posts:', error)
  }
}

await load(route.params.id as string)
</script>
<template>
  <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md">
    <div class="pt-8">
      <div class="flex gap-2.5">
        <StoreIcon />
        <h1 class="font-body text-sumi-900 leading-relaxed text-xl">{{ post?.store_name }}</h1>
      </div>
      <div class="mt-20 flex items-center text-sumi-600 gap-3">
        <PostUserProfileLink />
        <span>&brvbar;</span>
        <PostDateBrowseItem class="text-base" :date="post?.posted_at" />
      </div>
    </div>

    <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md mt-9">
      <article>
        <img :src="post?.post_img" class="w-full object-cover" alt="投稿画像" />
        <div class="my-12 font-body text-sumi-900 leading-relaxed">
          <p v-if="post?.comment">{{ post.comment }}</p>
          <p v-else>一言感想はありません。</p>
        </div>
      </article>
    </div>
  </div>
</template>
