<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
import LoadingSpinner from '@/views/atoms/LoadingSpinner.vue'

</script>
<template>
  <BaseButton class="flex gap-2 items-center" type="submit" text="更新する">
    <LoadingSpinner />
  </BaseButton>
</template>
