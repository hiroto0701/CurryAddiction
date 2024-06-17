<script setup lang="ts">
import CardImg from '@/views/atoms/CardImg.vue'
import CardBody from '@/views/molecules/card/CardBody.vue'

interface Props {
  readonly src: string
  readonly storeName: string
  readonly location: string
  readonly date: string
}

defineProps<Props>()

const emit = defineEmits<{
  (e: 'clickItem'): void
}>()
</script>
<template>
  <div
    class="h-80 rounded-lg overflow-hidden cursor-pointer duration-300 hover:opacity-80 border border-gray-200"
    @click="emit('clickItem')"
  >
    <CardImg :src />
    <CardBody :store-name="storeName" :location :date />
  </div>
</template>
