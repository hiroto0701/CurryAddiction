<script setup lang="ts">
import RegionSettingButton from '@/views/molecules/buttons/RegionSettingButton.vue';

const emit = defineEmits<{
  (e: 'edit'): void;
}>();
</script>
<template>
  <RegionSettingButton
    class="inline-flex items-center justify-center border px-4 py-3 text-sm"
    @click="emit('edit')"
  />
</template>
