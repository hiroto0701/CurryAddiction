<script setup lang="ts">
import TrashIcon from '@/views/atoms/icons/TrashIcon.vue'
import BackToHomeLink from '@/views/molecules/links/BackToHomeLink.vue'
import EditPostLink from '@/views/molecules/links/EditPostLink.vue'
import PostDetail from '@/views/pages/Post/components/PostDetail.vue'
import PostDetailSkeleton from '@/views/pages/Post/components/PostDetailSkeleton.vue'
</script>
<template>
  <div class="flex items-center justify-between h-12 lg:sticky lg:top-0">
    <BackToHomeLink />
    <div class="flex items-center gap-2">
      <EditPostLink />
      <TrashIcon />
    </div>
  </div>

  <Suspense>
    <template #default>
      <PostDetail />
    </template>

    <template #fallback>
      <PostDetailSkeleton />
    </template>
  </Suspense>
</template>
