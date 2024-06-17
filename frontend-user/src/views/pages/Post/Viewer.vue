<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { usePostFormStore } from '@/stores/post_form'

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
  <h1 class="font-body text-sumi-900">{{ postData.store_name }}</h1>
  <p class="font-body text-sumi-900">{{ postData.genre_id }}</p>
  <p class="font-body text-sumi-900">{{ postData.comment }}</p>
  <img :src="postData.post_img" alt="投稿画像" />
</template>
