<script setup lang="ts">
import ProfileIcon from '@/views/atoms/icons/ProfileIcon.vue'
// interface Props {
//   readonly profile: null | string
// }

// defineProps<Props>()
</script>
<template>
  <!-- widthは親要素で指定 -->
  <div class="relative aspect-square">
    <!-- <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full object-cover"> -->
    <ProfileIcon class="h-full w-full rounded-full object-cover" />
  </div>
</template>
