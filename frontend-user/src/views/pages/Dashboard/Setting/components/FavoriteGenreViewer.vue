<script setup lang="ts">
import GenreSettingButton from '@/views/molecules/buttons/GenreSettingButton.vue';

// interface Props {
//   readonly displayName?: string;
// }
// defineProps<Props>();

const emit = defineEmits<{
  (e: 'edit'): void;
}>();
</script>
<template>
  <GenreSettingButton
    class="inline-flex items-center justify-center border px-4 py-3 text-sm"
    @click="emit('edit')"
  />
</template>
