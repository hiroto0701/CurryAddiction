<script setup lang="ts">
interface Props {
  items: string[];
}

defineProps<Props>();
</script>
<template>
  <ul class="mt-5 flex flex-col gap-2 pl-8 font-body text-sm leading-relaxed text-sumi-800">
    <li v-for="(item, index) in items" :key="index" class="list-disc">
      {{ item }}
    </li>
  </ul>
</template>
