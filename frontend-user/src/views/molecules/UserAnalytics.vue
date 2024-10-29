<script setup lang="ts">
import PostIcon from '@/views/atoms/icons/PostIcon.vue';
import CalenderIcon from '@/views/atoms/icons/CalenderIcon.vue';
import SignUpDateBrowseItem from '@/views/molecules/browseItems/SignUpDateBrowseItem.vue';
import PostSummaryBrowseItem from '@/views/molecules/browseItems/PostSummaryBrowseItem.vue';

interface Props {
  readonly registeredAt: string;
  readonly postSummary: number;
}

defineProps<Props>();
</script>

<template>
  <div class="leading-normal">
    <div class="flex min-h-14 items-center">
      <div class="flex items-center">
        <span class="inline-flex w-7 items-center font-body text-sumi-900">
          <CalenderIcon class="text-sumi-500" />
        </span>
        <span class="w-28 font-body text-sm text-sumi-500">利用開始</span>
      </div>
      <SignUpDateBrowseItem :date="registeredAt" />
    </div>
    <div class="flex min-h-14 items-center border-t">
      <p class="flex items-center">
        <span class="inline-flex w-7 items-center font-body text-sumi-900">
          <PostIcon class="text-sumi-500" />
        </span>
        <span class="w-28 font-body text-sm text-sumi-500">投稿数</span>
      </p>
      <PostSummaryBrowseItem :post-summary />
    </div>
  </div>
</template>
