<script setup lang="ts">
import ProfileContent from '@/views/pages/Account/components/ProfileContent.vue'
import ProfileSkeleton from '@/views/pages/Account/components/ProfileSkeleton.vue'
import PostList from '@/views/pages/Post/components/PostList.vue'
import PostListSkeleton from '@/views/pages/Post/components/PostListSkeleton.vue'
</script>
<template>
  <Suspense>
    <template #default>
      <ProfileContent />
    </template>

    <template #fallback>
      <ProfileSkeleton />
    </template>
  </Suspense>

  <Suspense>
    <template #default>
      <PostList />
    </template>

    <template #fallback>
      <PostListSkeleton />
    </template>
  </Suspense>
</template>
