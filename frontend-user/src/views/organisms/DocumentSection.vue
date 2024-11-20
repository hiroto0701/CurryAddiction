<script setup lang="ts">
import BaseParagraph from '@/views/atoms/document/BaseParagraph.vue';
import BaseSection from '@/views/molecules/document/BaseSection.vue';
import BaseOrderedList from '@/views/molecules/document/BaseOrderedList.vue';

interface Props {
  title: string;
  paragraphs: string[];
  list?: string[];
}

defineProps<Props>();
</script>

<template>
  <BaseSection :title="title">
    <BaseParagraph v-for="(paragraph, index) in paragraphs" :key="index">
      {{ paragraph }}
    </BaseParagraph>
    <BaseOrderedList v-if="list" :items="list" />
    <slot />
  </BaseSection>
</template>
