<script setup lang="ts">
import CardIcons from '@/views/molecules/card/CardIcons.vue'
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue'
import StoreLocationBrowseItem from '@/views/molecules/browseItems/StoreLocationBrowseItem.vue'
import PostDateBrowseItem from '@/views/molecules/browseItems/PostDateBrowseItem.vue'

interface Props {
  readonly storeName: string
  readonly location: string
  readonly date: string
}
defineProps<Props>()
</script>
<template>
  <div class="flex flex-col justify-between h-28 pb-2">
    <CardIcons />
    <StoreNameBrowseItem class="text-md px-3 py-1 text-sumi-900" :store-name="storeName" />
    <div class="flex justify-between items-center">
      <StoreLocationBrowseItem :location :date />
      <PostDateBrowseItem class="text-xs" :date />
    </div>
  </div>
</template>
