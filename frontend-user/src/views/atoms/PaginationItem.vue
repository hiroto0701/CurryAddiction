<script setup lang="ts">
interface Props {
  text: string | number;
  active?: boolean;
  disabled: boolean;
}
defineProps<Props>();
</script>
<template>
  <li
    class="inline-flex items-center border border-gray-200 font-body text-sm text-sumi-500 duration-500 first-of-type:rounded-l-full last-of-type:rounded-r-full hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
    :class="{
      'bg-sumi-100 text-sumi-900': active,
      'opacity-50': disabled,
      'cursor-not-allowed': disabled
    }"
  >
    <button
      class="px-4 py-2"
      :class="{
        'cursor-not-allowed': disabled
      }"
      type="button"
    >
      {{ text }}
    </button>
  </li>
</template>
