<script setup lang="ts">
import { computed, inject } from 'vue'
import { useAccountStore } from '@/stores/account'
import PostIcon from '@/views/atoms/icons/PostIcon.vue'
import CalenderIcon from '@/views/atoms/icons/CalenderIcon.vue'
import SignUpDateBrowseItem from '@/views/molecules/browseItems/SignUpDateBrowseItem.vue'
import PostSummaryBrowseItem from '@/views/molecules/browseItems/PostSummaryBrowseItem.vue'

const accountStore = useAccountStore()

const dayjs = inject('$dayjs') as typeof import('dayjs')

const signUpDate = computed(() => dayjs(accountStore.state.registered_at).format('YYYY年M月'))
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
      <SignUpDateBrowseItem :sign-up-date="signUpDate" />
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
