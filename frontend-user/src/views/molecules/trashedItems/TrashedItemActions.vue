<script setup lang="ts">
import axios from 'axios'
import { ref } from 'vue'
import { useCommonStore } from '@/stores/common'
import CalenderIcon from '@/views/atoms/icons/CalenderIcon.vue'
import StoreNameBrowseItem from '@/views/molecules/browseItems/StoreNameBrowseItem.vue'
import TrashedDateBrowseItem from '@/views/molecules/browseItems/TrashedDateBrowseItem.vue'
import DeletePostButton from '@/views/molecules/buttons/DeletePostButton.vue'
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue'

const commonStore = useCommonStore()
const open = ref<boolean>(false)

function openModal(): void {
  open.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  open.value = false
  document.body.style.overflow = 'auto'
}

async function doHardDelete() {
  // try {
  //   commonStore.startApiLoading()
  //   const response = await softDeletePost(route.params.id as string)

  //   if (response.status === 200) {
  //     closeModal()
  //     await router.push({ name: 'Home' }).then((): void => {
  //       commonStore.setFlashMessage('投稿をごみ箱に入れました')
  //       setTimeout(() => {
  //         commonStore.clearFlashMessage()
  //       }, 4000)
  //     })
  //   } else {
  //     throw new Error(response.data.message)
  //   }
  // } catch (error) {
  //   console.error('Failed to delete the post:', error)
  //   if (axios.isAxiosError(error)) {
  //     console.log(`削除に失敗しました: ${error.response?.data?.message || error.message}`, error)
  //   } else {
  //     console.log('予期せぬエラーが発生しました', error)
  //   }
  // } finally {
  //   commonStore.stopApiLoading()
  // }

  console.log('todo')
}
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
        <DeletePostButton @delete="openModal" text="完全に削除する" />
      </div>
    </div>
  </div>

  <Teleport to="body">
    <DeleteConfirmModal
      v-show="open"
      :is-loading="commonStore.state.apiLoading"
      modal-title="完全に削除しますか？"
      modal-content="削除した投稿は復元できません。"
      button-text="削除する"
      @delete="doHardDelete"
      @cancel="closeModal"
      :closeModal="closeModal"
    />
  </Teleport>
</template>
