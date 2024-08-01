<script setup lang="ts">
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue'
import MeatballMenuIcon from '@/views/atoms/icons/MeatballMenuIcon.vue'
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
  readonly isMine: boolean
}
defineProps<Props>()

const emits = defineEmits<{
  (e: 'navigateToDetail'): void
  (e: 'like'): void
  (e: 'archive'): void
  (e: 'handlePost'): void
}>()
</script>
<template>
  <article class="overflow-hidden rounded-lg border border-gray-200">
    <div class="flex h-14 items-center justify-between border-b border-gray-200 bg-white p-3">
      <PostUserProfileLink
        class="w-fit max-w-40 text-xs"
        :display-name="displayName"
        :handle-name="handleName"
        :avatar-url
      />
      <div>
        <Menu as="div" class="relative">
          <MenuButton
            class="relative flex aspect-square w-8 items-center justify-center rounded-full duration-300 md:hover:bg-gray-100"
            v-if="isMine"
            aria-label="投稿用メニューを開く"
          >
            <MeatballMenuIcon class="w-5" />
          </MenuButton>
          <Transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
          >
            <MenuItems
              class="absolute right-[-.5rem] top-[1.7rem] z-10 mt-2 w-40 rounded-xl border border-gray-200 bg-white p-1 shadow-lg"
            >
              <MenuItem class="flex items-center justify-between rounded-lg p-2 text-sm">
                <button
                  class="w-full bg-white font-body text-sm text-red-400 duration-300 md:hover:bg-red-50"
                  @click="emits('handlePost')"
                >
                  <TrashIcon />
                  ごみ箱に入れる
                </button>
              </MenuItem>
            </MenuItems>
          </Transition>
        </Menu>
      </div>
    </div>
    <CardImg
      :src
      class="cursor-pointer sm:peer-hover:opacity-80"
      @click="emits('navigateToDetail')"
    />
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
