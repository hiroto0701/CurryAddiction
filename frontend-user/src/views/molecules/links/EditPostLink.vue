<script setup lang="ts">
import { RouterLink } from 'vue-router'
import EditIcon from '@/views/atoms/icons/EditIcon.vue'
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue'
</script>
<template>
  <BottomTooltip text="投稿を編集" position="bottom">
    <router-link
      :to="{ name: 'Home' }"
      class="peer flex aspect-square w-8 items-center justify-center rounded-full transition-opacity duration-500 hover:bg-gray-100"
    >
      <EditIcon />
    </router-link>
  </BottomTooltip>
</template>
