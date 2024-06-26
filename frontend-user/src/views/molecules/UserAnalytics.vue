<script setup lang="ts">
import { useAccountStore } from '@/stores/account'
import PostIcon from '@/views/atoms/icons/PostIcon.vue'
import CalenderIcon from '@/views/atoms/icons/CalenderIcon.vue'
import SignUpDateBrowseItem from '@/views/molecules/browseItems/SignUpDateBrowseItem.vue'
import PostSummaryBrowseItem from '@/views/molecules/browseItems/PostSummaryBrowseItem.vue'

interface Props {
  readonly registeredAt: string
  // readonly postSummary: number
}
defineProps<Props>()

const accountStore = useAccountStore()
</script>
<template>
  <div class="leading-normal">
    <div class="flex items-center min-h-14">
      <div class="flex items-center">
        <span class="inline-flex w-7 items-center text-sumi-900 font-body">
          <CalenderIcon class="text-sumi-500" />
        </span>
        <span class="text-sumi-500 font-body text-sm w-28">利用開始</span>
      </div>
      <SignUpDateBrowseItem :date="accountStore.state.registered_at" />
    </div>
    <div class="flex items-center border-t min-h-14">
      <p class="flex items-center">
        <span class="inline-flex w-7 items-center text-sumi-900 font-body">
          <PostIcon class="text-sumi-500" />
        </span>
        <span class="text-sumi-500 font-body text-sm w-28">投稿数</span>
      </p>
      <PostSummaryBrowseItem :post-summary="5" />
    </div>
  </div>
</template>
