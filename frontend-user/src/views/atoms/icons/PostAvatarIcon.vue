<script setup lang="ts">
import { computed } from 'vue'

interface Props {
  readonly avatarUrl: string | null
}
const prop = defineProps<Props>()

const avatar = computed((): string => {
  if (prop.avatarUrl === null) {
    const defaultAvatar = '../../../../public/icon/default_avatar.jpg'
    return defaultAvatar
  } else {
    return prop.avatarUrl
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
