<script setup lang="ts">
import BaseParagraph from '@/views/pages/PrivacyPolicy/components/atoms/BaseParagraph.vue';
import BaseSection from '@/views/pages/PrivacyPolicy/components/molecules/BaseSection.vue';
import BaseOrderedList from '@/views/pages/PrivacyPolicy/components/molecules/BaseOrderedList.vue';

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
