<script setup lang="ts">
import { MenuItem } from '@headlessui/vue';
import type { Notification } from '@/types/notification';
import NotifiedUserProfileLink from '@/views/molecules/links/NotifiedUserProfileLink.vue';
import NotificationContent from '@/views/molecules/NotificationContent.vue';

interface Props {
  readonly notification: Notification;
}
defineProps<Props>();
</script>
<template>
  <MenuItem class="border-t border-gray-200 px-4 py-3 first:border-none" v-slot="{}">
    <div class="flex justify-between">
      <NotifiedUserProfileLink
        :avatar-url="notification.notified_from_user.avatar_url"
        :handle-name="notification.notified_from_user.handle_name"
      />
      <NotificationContent
        class="w-[calc(100%-50px)] font-body text-xs leading-5 text-utility"
        :display-name="notification.notified_from_user.display_name"
        :handle-name="notification.notified_from_user.handle_name"
        :store-name="notification.notified_target.store_name"
        :slug="notification.notified_target.slug"
      />
    </div>
  </MenuItem>
</template>
<style scoped></style>
