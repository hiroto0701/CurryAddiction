<script setup lang="ts">
import CardImg from '@/views/atoms/CardImg.vue'
import CardBody from '@/views/molecules/card/CardBody.vue'
import PostUserProfileLink from '@/views/molecules/links/PostUserProfileLink.vue'

interface Props {
  readonly src: string
  readonly storeName: string
  readonly location: string
  readonly date: string
  readonly displayName: string
  readonly handleName: string
  readonly avatarUrl: string | null
  readonly isLiked: boolean
  readonly isArchived: boolean
}
defineProps<Props>()

const emits = defineEmits<{
  (e: 'clickItem'): void
  (e: 'like'): void
  (e: 'archive'): void
}>()
</script>
<template>
  <article class="overflow-hidden rounded-lg border border-gray-200">
    <div class="h-12 border-b border-gray-200 bg-white p-3">
      <PostUserProfileLink
        class="w-fit max-w-40 text-xs"
        :display-name="displayName"
        :handle-name="handleName"
        :avatar-url
      />
    </div>
    <CardImg :src class="cursor-pointer sm:peer-hover:opacity-80" @click="emits('clickItem')" />
    <CardBody
      :store-name="storeName"
      :location
      :date
      :is-liked
      :is-archived
      @like="emits('like')"
      @archive="emits('archive')"
    />
  </article>
</template>
