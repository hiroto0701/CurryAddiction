<script setup lang="ts">
import BaseButton from '@/views/atoms/BaseButton.vue'
import Loading from '@/views/atoms/Loading.vue'

</script>
<template>
  <BaseButton class="flex gap-2 items-center" type="submit" text="更新する">
    <Loading />
  </BaseButton>
</template>
