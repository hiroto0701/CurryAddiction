<script setup lang="ts">
import CalenderIcon from '@/views/atoms/icons/CalenderIcon.vue';
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue';
import DateBrowseItem from '@/views/molecules/browseItems/DateBrowseItem.vue';
import DeletePostButton from '@/views/molecules/buttons/DeletePostButton.vue';

interface Props {
  readonly storeName: string;
  readonly deletedAt: string;
}
defineProps<Props>();

const emits = defineEmits(['restore', 'delete']);
</script>
<template>
  <div class="flex-1">
    <StoreNameBrowseItem
      class="mt-0.5 line-clamp-2 text-sm text-gray-500"
      :store-name="storeName"
    />
    <div class="text-3xs mt-1.5 leading-normal">
      <div class="flex items-center gap-2.5">
        <CalenderIcon class="text-gray-500" />
        <span class="font-body text-sm text-gray-500">削除した日付:</span>
        <DateBrowseItem class="py-1 pr-2 text-sm" :date="deletedAt" />
      </div>
      <div class="mt-3 flex items-center gap-2.5">
        <button
          @click="emits('restore')"
          class="border-sumi-250 rounded-full border px-2.5 py-1.5 text-sm text-sumi-700 hover:bg-sumi-100"
        >
          元に戻す
        </button>
        <DeletePostButton @delete="emits('delete')" text="完全に削除する" />
      </div>
    </div>
  </div>
</template>
