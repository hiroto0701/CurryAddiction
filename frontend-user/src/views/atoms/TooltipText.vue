<script setup lang="ts">
interface Props {
  readonly text: string
  readonly position: 'top' | 'bottom'
  readonly open?: boolean
}

defineProps<Props>()
</script>
<template>
  <span
    class="absolute opacity-0 peer-hover:opacity-100 duration-300 flex justify-center items-center px-2 py-2 shadow-sm border border-gray-200 whitespace-nowrap font-body text-xs text-sumi-500 bg-white rounded-lg"
    :class="{
      'top-[-3rem]': position === 'top',
      'bottom-[-2.5rem]': position === 'bottom',
      hidden: open
    }"
  >
    {{ text }}
  </span>
</template>
