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
</script>
<template>
  <div class="h-80 rounded-lg overflow-hidden border border-gray-200">
    <CardImg :src />
    <CardBody :store-name="storeName" :location :date />
  </div>
</template>
