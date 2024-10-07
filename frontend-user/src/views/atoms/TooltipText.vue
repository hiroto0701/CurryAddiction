<script setup lang="ts">
interface Props {
  readonly text: string;
  readonly position: 'top' | 'bottom';
  readonly open?: boolean;
}

defineProps<Props>();
</script>
<template>
  <span
    class="absolute hidden select-none items-center justify-center whitespace-nowrap rounded-lg border border-gray-200 bg-white px-2 py-2 font-body text-xs text-sumi-500 opacity-0 shadow-sm duration-300 md:flex md:peer-hover:opacity-100"
    :class="{
      'top-[-3rem]': position === 'top',
      'bottom-[-2.5rem]': position === 'bottom',
      hidden: open
    }"
  >
    {{ text }}
  </span>
</template>
