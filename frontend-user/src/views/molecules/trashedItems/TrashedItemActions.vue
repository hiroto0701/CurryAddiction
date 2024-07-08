<script setup lang="ts">
import CalenderIcon from '@/views/atoms/icons/CalenderIcon.vue'
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue'
import TrashedDateBrowseItem from '@/views/molecules/browseItems/TrashedDateBrowseItem.vue'
import HardDeletePostButton from '@/views/molecules/buttons/HardDeletePostButton.vue'
</script>
<template>
  <div class="flex-1">
    <StoreNameBrowseItem class="mt-0.5 text-sm line-clamp-2 text-gray-500" store-name="storeName" />
    <div class="mt-1.5 text-3xs leading-normal">
      <div class="flex items-center gap-2.5">
        <CalenderIcon class="text-gray-500" />
        <span class="font-body text-gray-500">削除した日付:</span>
        <TrashedDateBrowseItem class="text-base" date="2024/7/7" />
      </div>
      <div class="mt-3 flex items-center gap-2.5">
        <button
          class="rounded-full border border-sumi-250 py-1.5 px-2.5 text-4xs text-sumi-700 hover:bg-sumi-100"
        >
          元に戻す
        </button>
        <HardDeletePostButton />
      </div>
    </div>
  </div>
</template>
