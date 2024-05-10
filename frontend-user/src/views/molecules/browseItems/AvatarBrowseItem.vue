<script setup lang="ts">
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue'
// interface Props {
//   readonly profile: null | string
// }

// defineProps<Props>()
</script>
<template>
  <!-- widthは親要素で指定 -->
  <div class="relative ">
    <!-- <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full object-cover"> -->
    <AvatarIcon class="h-full w-full rounded-full object-cover" />
  </div>
</template>
