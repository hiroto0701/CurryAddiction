import dayjs from 'dayjs';
import { ref, onMounted, onUnmounted } from 'vue';

export function useRelativeTime(date: Date | string) {
  const relativeTime = ref(calculateRelativeTime(date));

  function calculateRelativeTime(date: Date | string): string {
    const now = dayjs();
    const past = dayjs(date);
    const diffInSeconds = now.diff(past, 'second');

    if (diffInSeconds < 60) {
      return 'たった今';
    } else if (diffInSeconds < 60 * 60) {
      const minutes = now.diff(past, 'minute');
      return `${minutes}分前`;
    } else if (diffInSeconds < 60 * 60 * 24) {
      const hours = now.diff(past, 'hour');
      return `${hours}時間前`;
    } else if (diffInSeconds < 60 * 60 * 24 * 31) {
      const days = now.diff(past, 'day');
      return `${days}日前`;
    } else if (diffInSeconds < 60 * 60 * 24 * 365) {
      const months = now.diff(past, 'month');
      return `${months}ヶ月前`;
    } else {
      return past.format('YYYY/MM/DD');
    }
  }

  let timer: number;

  onMounted(() => {
    const updateInterval = () => {
      const secondsDiff = dayjs().diff(dayjs(date), 'second');
      return secondsDiff < 60 * 60 ? 10000 : 60000;
    };

    const updateTime = () => {
      relativeTime.value = calculateRelativeTime(date);
      timer = window.setTimeout(updateTime, updateInterval());
    };

    updateTime();
  });

  onUnmounted(() => {
    clearTimeout(timer);
  });

  return relativeTime;
}
