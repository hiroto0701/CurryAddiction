<script setup lang="ts">
import Card from '@/views/molecules/card/Card.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'
import ProfileContent from '@/views/pages/Account/components/ProfileContent.vue'
import PostList from '@/views/pages/Post/components/PostList.vue'
import PostListSkeleton from '@/views/pages/Post/components/PostListSkeleton.vue'
</script>
<template>
  <Suspense>
    <template #default>
      <ProfileContent />
    </template>

    <template #fallback>
      <p>loading......</p>
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
