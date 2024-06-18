<script setup lang="ts">
import { RouterLink } from 'vue-router'
import EditIcon from '@/views/atoms/icons/EditIcon.vue'
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue'
</script>
<template>
  <BottomTooltip text="投稿を編集" position="bottom">
    <router-link
      :to="{ name: 'Home' }"
      class="peer w-8 aspect-square rounded-full transition-opacity duration-500 hover:bg-gray-100 flex items-center justify-center"
    >
      <EditIcon class="peer" />
    </router-link>
  </BottomTooltip>
</template>
