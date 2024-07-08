<script setup lang="ts">
import TrashedItemPreview from '@/views/molecules/trashedItems/TrashedItemPreview.vue'
import TrashedItemActions from '@/views/molecules/trashedItems/TrashedItemActions.vue'
</script>
<template>
  <div class="flex gap-5 sm:gap-7">
    <TrashedItemPreview />
    <TrashedItemActions />
  </div>
</template>
