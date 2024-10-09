<script setup lang="ts">
import CardIcons from '@/views/molecules/card/CardIcons.vue';
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue';
import StoreLocationBrowseItem from '@/views/molecules/browseItems/StoreLocationBrowseItem.vue';
import DateBrowseItem from '@/views/molecules/browseItems/DateBrowseItem.vue';

interface Props {
  readonly storeName: string;
  readonly location: string;
  readonly date: string;
  readonly isLiked: boolean;
  readonly isArchived: boolean;
}
defineProps<Props>();

const emits = defineEmits<{
  (e: 'like'): void;
  (e: 'archive'): void;
}>();
</script>
<template>
  <div class="flex h-28 flex-col justify-between pb-2">
    <CardIcons :is-liked :is-archived @like="emits('like')" @archive="emits('archive')" />
    <StoreNameBrowseItem class="text-md px-3 py-1 text-sumi-900" :store-name="storeName" />
    <div class="flex items-center justify-between">
      <StoreLocationBrowseItem :location :date />
      <DateBrowseItem class="py-1 pr-2 text-xs" :date />
    </div>
  </div>
</template>
