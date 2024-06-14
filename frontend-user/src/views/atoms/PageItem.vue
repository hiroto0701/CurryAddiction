<script setup lang="ts">
interface Props {
  text: string | number
  active?: boolean
}
defineProps<Props>()
</script>
<template>
  <li
    class="relative inline-flex items-center px-4 py-2 font-body text-sumi-500 text-sm border border-gray-20 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 first-of-type:rounded-l-full last-of-type:rounded-r-full cursor-pointer"
    :class="{ 'bg-sumi-100 text-sumi-900': active }"
  >
    <button type="button">
      {{ text }}
    </button>
  </li>
</template>
