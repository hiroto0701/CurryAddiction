<script setup lang="ts">
import CardIconsArea from '@/views/atoms/CardIconsArea.vue'
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue'
import StoreLocationBrowseItem from '@/views/molecules/browseItems/StoreLocationBrowseItem.vue'

interface Props {
  readonly storeName: string,
  readonly location: string,
  readonly date: string,
}

defineProps<Props>();
</script>
<template>
  <div class="flex flex-col justify-between h-28 pb-4">
    <CardIconsArea />
    <StoreNameBrowseItem :store-name="storeName" />
    <StoreLocationBrowseItem :location="location" :date="date" />
  </div>
</template>
