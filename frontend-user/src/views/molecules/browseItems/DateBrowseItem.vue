<script setup lang="ts">
import { computed, inject } from 'vue';
import { useRelativeTime } from '@/composables/functions/useRelativeTime';
import Date from '@/views/atoms/Date.vue';

interface Props {
  readonly date: string;
}
const props = defineProps<Props>();

const dayjs = inject('$dayjs') as typeof import('dayjs');
const fullDate = computed(() => dayjs(props.date).format('YYYY/M/D'));

// 相対時間を計算
const relativeTime = useRelativeTime(props.date || '');

// 表示する日付を決定
const displayDate = computed(() => {
  if (!props.date) return '';
  const now = dayjs();
  const postDate = dayjs(props.date);
  const diffInDays = now.diff(postDate, 'day');

  if (diffInDays < 365) {
    return relativeTime.value;
  } else {
    return fullDate.value;
  }
});
</script>
<template>
  <Date class="text-utility" :date="props.date" :formatted-date="displayDate" />
</template>
