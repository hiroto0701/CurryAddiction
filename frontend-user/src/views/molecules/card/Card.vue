<script setup lang="ts">
import CardImg from '@/views/atoms/CardImg.vue'
import CardBody from '@/views/molecules/card/CardBody.vue'

interface Props {
  readonly src: string
  readonly storeName: string
  readonly location: string
  readonly date: string
  readonly isLiked: boolean
  readonly isArchived: boolean
}
defineProps<Props>()

const emits = defineEmits<{
  (e: 'clickItem'): void
  (e: 'toggleLike'): void
  (e: 'toggleArchive'): void
}>()
</script>
<template>
  <div
    class="group sm:h-[325px] rounded-lg overflow-hidden cursor-pointer border border-gray-200"
    @click="emits('clickItem')"
  >
    <CardImg :src class="sm:group-hover:opacity-80 duration-300" />
    <CardBody
      :store-name="storeName"
      :location
      :date
      :is-liked
      :is-archived
      @toggle-like="emits('toggleLike')"
      @toggle-archive="emits('toggleArchive')"
    />
  </div>
</template>
