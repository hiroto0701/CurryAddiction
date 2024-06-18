<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { usePostFormStore } from '@/stores/post_form'
import PostAvatarIcon from '@/views/atoms/icons/PostAvatarIcon.vue'
import PostDateBrowseItem from '@/views/molecules/browseItems/PostDateBrowseItem.vue'

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
  <div class="mx-auto w-full px-6 xs:px-7 sm:px-10 max-w-screen-md">
    <div class="pt-24 md:pt-28">
      <h1 class="font-body text-sumi-900 leading-relaxed text-xl">{{ postData.store_name }}</h1>
      <div class="mt-20 flex items-center text-sumi-600">
        <a class="flex min-w-0 items-center gap-2.5 text-sm hover:text-sumi-900" href="#">
          <PostAvatarIcon />
          <span class="max-w-40 truncate font-body inline-block">
            {{ postData.user.display_name }}
          </span>
        </a>
        <PostDateBrowseItem class="ml-5" :date="postData.posted_at" />
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
