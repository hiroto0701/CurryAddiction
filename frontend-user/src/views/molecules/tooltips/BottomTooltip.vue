<script setup lang="ts">
import TooltipContainer from '@/views/atoms/TooltipContainer.vue';
import TooltipText from '@/views/atoms/TooltipText.vue';

interface Props {
  readonly text: string;
  readonly position: 'bottom';
  readonly open?: boolean;
}
defineProps<Props>();
</script>

<template>
  <TooltipContainer>
    <slot />
    <TooltipText :text :position :open />
  </TooltipContainer>
</template>
