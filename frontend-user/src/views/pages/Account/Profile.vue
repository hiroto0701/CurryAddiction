<script setup lang="ts">
import { ref, provide, onErrorCaptured } from 'vue';
import { useRouter } from 'vue-router';
import type { ServiceUser } from '@/composables/types/serviceUser';
import ProfileContent from '@/views/pages/Account/components/ProfileContent.vue';
import ProfileSkeleton from '@/views/pages/Account/components/ProfileSkeleton.vue';
import PostList from '@/views/organisms/PostList.vue';
import PostListSkeleton from '@/views/organisms/PostListSkeleton.vue';
import ProfilePagePlaceholder from '@/views/molecules/noContentPlaceholder/ProfilePagePlaceholder.vue';

const router = useRouter();
const error = ref<Error | null>(null);
const pageUser = ref<ServiceUser>({} as ServiceUser);
provide('pageUser', pageUser);

onErrorCaptured((err: unknown) => {
  if (err instanceof Error) {
    error.value = err;
    if (err.message === '404 not found') {
      router.replace({ name: 'ErrorNotFound' });
    }
  }
  return false;
});
</script>
<template>
  <template v-if="!error">
    <Suspense>
      <template #default>
        <ProfileContent @user-loaded="pageUser = $event" />
      </template>
      <template #fallback>
        <ProfileSkeleton />
      </template>
    </Suspense>

    <Suspense v-if="pageUser?.user_id">
      <template #default>
        <PostList :placeholder-component="ProfilePagePlaceholder" page-type="profile" />
      </template>
      <template #fallback>
        <PostListSkeleton />
      </template>
    </Suspense>
  </template>
</template>
