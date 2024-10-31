<script setup lang="ts">
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue';
import EditDisplayNameButton from '@/views/molecules/buttons/EditDisplayNameButton.vue';

interface Props {
  readonly displayName?: string;
}
defineProps<Props>();

const emit = defineEmits<{
  (e: 'edit'): void;
}>();
</script>

<template>
  <DisplayNameBrowseItem :display-name class="mt-3 text-sm text-utility" />
  <EditDisplayNameButton
    class="mt-4 inline-flex items-center justify-center border px-4 py-3 text-sm"
    @click="emit('edit')"
  />
</template>
