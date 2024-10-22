<script setup lang="ts">
import { ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import type { ServiceUser } from '@/types/serviceUser';
import { useFetchProfile } from '@/composables/useFetchProfile';
import GotoSettingPageButton from '@/views/molecules/buttons/GotoSettingPageButton.vue';
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue';
import HandleNameBrowseItem from '@/views/molecules/browseItems/HandleNameBrowseItem.vue';
import AvatarBrowseItem from '@/views/molecules/browseItems/AvatarBrowseItem.vue';
import UserAnalytics from '@/views/molecules/UserAnalytics.vue';

const { fetchProfile } = useFetchProfile();
const route = useRoute();

const service_user = ref<ServiceUser>({} as ServiceUser);

const emit = defineEmits<{
  (e: 'user-loaded', user: ServiceUser): void;
}>();

async function loadUser(username: string) {
  try {
    const data = await fetchProfile(username);
    service_user.value = data;
    emit('user-loaded', data);
  } catch (error) {
    console.error('ユーザーの読み込みに失敗しました。:', error);
    throw new Error('404 not found');
  }
}

await loadUser(route.params.username as string);

watch(
  () => route.params.username,
  async (newUsername) => {
    if (newUsername) {
      await loadUser(newUsername as string);
    }
  }
);
</script>
<template>
  <div class="mb-12 overflow-hidden rounded-2xl border p-6 md:p-7">
    <div class="flex items-center gap-3.5 py-6">
      <AvatarBrowseItem class="w-16 flex-shrink-0 md:w-24" :avatar-url="service_user.avatar_url" />
      <div class="flex min-w-0 flex-1 flex-col gap-1 overflow-hidden">
        <DisplayNameBrowseItem
          :display-name="service_user.display_name"
          class="md:text-md max-w-[300px] truncate break-words text-sm text-sumi-900 md:max-w-full"
        />
        <HandleNameBrowseItem :handle-name="service_user.handle_name" />
      </div>
      <GotoSettingPageButton
        v-if="service_user.is_mine"
        text="設定"
        class="hidden flex-shrink-0 sm:block"
      />
    </div>
    <UserAnalytics
      :registered-at="service_user.registered_at"
      :post-summary="service_user.post_summary"
    />
  </div>
</template>
