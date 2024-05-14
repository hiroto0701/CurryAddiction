<script setup lang="ts">
interface Props {
  readonly text: string
}

defineProps<Props>()
</script>
<template>
  <button type="button" class="rounded-full font-body inline-flex items-center justify-center hover:opacity-70 hover:bg-slate-200 hover:border-slate-300 duration-500">
    {{ text }}
    <slot />
  </button>
</template>
