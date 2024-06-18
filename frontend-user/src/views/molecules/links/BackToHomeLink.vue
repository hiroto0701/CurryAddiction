<script setup lang="ts">
import { RouterLink } from 'vue-router'
import BackButtonIcon from '@/views/atoms/icons/BackButtonIcon.vue'
import BottomTooltip from '@/views/molecules/tooltips/BottomTooltip.vue'
</script>
<template>
  <BottomTooltip text="投稿一覧へ戻る" position="bottom">
    <router-link
      :to="{ name: 'Home' }"
      class="peer w-8 aspect-square rounded-full transition-opacity duration-500 hover:bg-gray-100 flex items-center justify-center"
    >
      <BackButtonIcon class="peer" />
    </router-link>
  </BottomTooltip>
</template>
