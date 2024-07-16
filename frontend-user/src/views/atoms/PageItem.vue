<script setup lang="ts">
interface Props {
  text: string | number
  active?: boolean
  disabled: boolean
}
defineProps<Props>()
</script>
<template>
  <li
    class="inline-flex items-center font-body text-sumi-500 text-sm border border-gray-200 duration-500 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 first-of-type:rounded-l-full last-of-type:rounded-r-full"
    :class="{
      'bg-sumi-100 text-sumi-900': active,
      hidden: disabled,
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
