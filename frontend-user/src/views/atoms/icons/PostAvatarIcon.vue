<script setup lang="ts">
import { computed } from 'vue'
import { usePostFormStore } from '@/stores/post_form'

const postFormStore = usePostFormStore()
const avatar = computed((): string => {
  if (postFormStore.state.user.avatar === null) {
    const defaultAvatar = '../../../../public/icon/default_avatar.jpg'
    return defaultAvatar
  } else {
    return postFormStore.state.user.avatar
  }
})
</script>
<template>
  <div class="w-7">
    <img
      :src="avatar"
      alt="プロフィール画像"
      class="object-cover aspect-square h-full w-full rounded-full bg-transparent"
    />
  </div>
</template>
