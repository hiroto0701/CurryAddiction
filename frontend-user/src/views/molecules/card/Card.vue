<script setup lang="ts">
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
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
            class="relative flex aspect-square w-8 items-center justify-center rounded-full duration-200 hover:bg-gray-100"
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
              class="absolute right-0 z-10 mt-2 w-24 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5"
            >
              <MenuItem class="flex items-center gap-x-2 px-4 text-sm">
                <button
                  class="w-full bg-red-50 p-3 font-body text-sm text-sumi-500 hover:text-sumi-900 md:hover:bg-slate-100"
                  @click="emits('handlePost')"
                >
                  削除する
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
