<script setup lang="ts">
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'

const click = (): void => {
  console.log('clicked');
}
</script>
<template>
  <div class="flex justify-between h-fit px-3 py-1.5">
    <HeartIcon class="text-gray-700 cursor-pointer" @click="click" />
    <ArchiveIcon class="text-gray-700 cursor-pointer" @click="click" />
  </div>
</template>