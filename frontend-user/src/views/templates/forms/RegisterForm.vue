<script setup lang="ts">
import BaseForm from '@/views/templates/forms/BaseForm.vue'

interface Props {
  readonly title: string;
}

defineProps<Props>();
</script>
<template>
  <BaseForm :title="title">
    <slot />
    <!-- <template #submit-button>
      <register-button class="px-5" />
    </template> -->
  </BaseForm>
</template>
