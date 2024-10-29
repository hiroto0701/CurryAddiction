<script setup lang="ts">
import LogoIcon from '@/views/atoms/icons/LogoIcon.vue';

interface Props {
  readonly title: string;
  readonly subTitle: string;
}
defineProps<Props>();
</script>

<template>
  <div class="flex flex-col items-center justify-center gap-4">
    <LogoIcon class="w-32" />
    <h1 class="font-TrainOne text-3xl text-sumi-900">{{ title }}</h1>
    <h2 class="font-body text-lg text-sumi-900">{{ subTitle }}</h2>
  </div>
</template>
