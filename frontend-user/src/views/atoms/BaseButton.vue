<script setup lang="ts">
interface Props {
  readonly text: string;
}

defineProps<Props>();
</script>

<template>
  <button
    type="button"
    class="flex cursor-pointer items-center justify-center rounded-full font-body duration-500 hover:opacity-70"
  >
    {{ text }}
    <slot />
  </button>
</template>
