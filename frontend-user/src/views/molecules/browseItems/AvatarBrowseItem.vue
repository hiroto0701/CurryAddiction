<script setup lang="ts">
import AvatarIcon from '@/views/atoms/icons/AvatarIcon.vue'

interface Props {
  readonly preview?: string
}
defineProps<Props>()
</script>
<template>
  <div class="relative border border-gray-300 rounded-full">
    <AvatarIcon :preview />
  </div>
</template>
