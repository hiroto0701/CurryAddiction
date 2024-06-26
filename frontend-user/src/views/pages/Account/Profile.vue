<script setup lang="ts">
import { ref, provide } from 'vue'
import type { ServiceUser } from '@/composables/types/serviceUser'
import ProfileContent from '@/views/pages/Account/components/ProfileContent.vue'
import ProfileSkeleton from '@/views/pages/Account/components/ProfileSkeleton.vue'
import PostList from '@/views/pages/Post/components/PostList.vue'
import PostListSkeleton from '@/views/pages/Post/components/PostListSkeleton.vue'

const pageUser = ref<ServiceUser>({} as ServiceUser)
provide('pageUser', pageUser)
</script>
<template>
  <Suspense>
    <template #default>
      <ProfileContent @user-loaded="pageUser = $event" />
    </template>

    <template #fallback>
      <ProfileSkeleton />
    </template>
  </Suspense>

  <Suspense v-if="pageUser.user_id">
    <template #default>
      <PostList />
    </template>

    <template #fallback>
      <PostListSkeleton />
    </template>
  </Suspense>
</template>
