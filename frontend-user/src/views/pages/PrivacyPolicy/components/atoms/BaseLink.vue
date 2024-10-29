<script setup lang="ts">
interface Props {
  href: string;
}

defineProps<Props>();
</script>

<template>
  <a
    :href
    target="_blank"
    rel="nofollow noopener noreferrer"
    class="text-sky-500 decoration-solid hover:underline"
  >
    <slot />
  </a>
</template>
