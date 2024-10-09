<script setup lang="ts">
import { computed, inject, ref, watchEffect } from 'vue';
import Date from '@/views/atoms/Date.vue';

interface Props {
  readonly date: string;
}
const props = defineProps<Props>();

const dayjs = inject('$dayjs') as typeof import('dayjs');

const fullDate = computed(() => dayjs(props.date).format('YYYY/MM/DD'));
const relativeTime = ref<string>('');

watchEffect(() => {
  if (!props.date) {
    relativeTime.value = '';
    return;
  }

  function updateRelativeTime() {
    const now = dayjs();
    const past = dayjs(props.date);
    const diffInSeconds = now.diff(past, 'second');

    if (diffInSeconds < 60) {
      relativeTime.value = 'たった今';
    } else if (diffInSeconds < 60 * 60) {
      const minutes = now.diff(past, 'minute');
      relativeTime.value = `${minutes}分前`;
    } else if (diffInSeconds < 60 * 60 * 24) {
      const hours = now.diff(past, 'hour');
      relativeTime.value = `${hours}時間前`;
    } else if (diffInSeconds < 60 * 60 * 24 * 31) {
      const days = now.diff(past, 'day');
      relativeTime.value = `${days}日前`;
    } else if (diffInSeconds < 60 * 60 * 24 * 365) {
      const months = now.diff(past, 'month');
      relativeTime.value = `${months}ヶ月前`;
    } else {
      relativeTime.value = past.format('YYYY/MM/DD');
    }
  }

  updateRelativeTime();

  const timer = setInterval(updateRelativeTime, 60000);

  return () => clearInterval(timer);
});

const displayDate = computed(() => {
  if (!props.date) return '';
  const now = dayjs();
  const postDate = dayjs(props.date);
  const diffInDays = now.diff(postDate, 'day');

  return diffInDays < 365 ? relativeTime.value : fullDate.value;
});
</script>
<template>
  <Date class="text-utility" :date="props.date" :formatted-date="displayDate" />
</template>
