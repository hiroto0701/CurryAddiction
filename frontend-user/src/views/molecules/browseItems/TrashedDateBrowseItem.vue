<script setup lang="ts">
import { computed, inject } from 'vue';
import Date from '@/views/atoms/Date.vue';

interface Props {
  readonly date?: string;
}
const props = defineProps<Props>();

const dayjs = inject('$dayjs') as typeof import('dayjs');
const trashedDate = computed(() => dayjs(props.date).format('YYYY/M/D'));
</script>
<template>
  <Date class="py-1 pr-2 text-gray-500" :date :formatted-date="trashedDate" />
</template>
