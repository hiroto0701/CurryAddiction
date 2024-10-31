<script setup lang="ts">
import { ref } from 'vue';
import { MenuItem } from '@headlessui/vue';
import type { Notification } from '@/types/notification';
import NotifiedUserProfileLink from '@/views/molecules/links/NotifiedUserProfileLink.vue';
import NotificationContent from '@/views/molecules/NotificationContent.vue';

interface Props {
  readonly notification: Notification;
}
const props = defineProps<Props>();

const avatarUrl = ref<string | null>(props.notification.notified_from_user.avatar_url);
const handleName = ref<string>(props.notification.notified_from_user.handle_name);
const displayName = ref<string>(props.notification.notified_from_user.display_name);
const storeName = ref<string>(props.notification.notified_target.store_name);
const slug = ref<string>(props.notification.notified_target.slug);
const notifiedAt = ref<string>(props.notification.created_at);
</script>

<template>
  <MenuItem class="border-t border-gray-200 px-4 py-3 first:border-none" v-slot="{ close }">
    <div class="flex justify-between">
      <NotifiedUserProfileLink :avatar-url :handle-name :close />
      <NotificationContent
        class="w-[calc(100%-50px)] font-body text-xs leading-5 text-utility"
        :display-name
        :handle-name
        :store-name
        :slug
        :notified-at
        :close
      />
    </div>
  </MenuItem>
</template>
