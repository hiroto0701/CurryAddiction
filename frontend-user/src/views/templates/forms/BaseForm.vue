<script setup lang="ts">
import BackLink from '@/views/molecules/links/BackLink.vue'
</script>
<template>
  <div class="flex h-12 items-center">
    <BackLink />
  </div>
  <form
    autocomplete="off"
    enctype="multipart/form-data"
    class="relative rounded-lg py-8 font-body md:px-20"
  >
    <slot />
  </form>
</template>
