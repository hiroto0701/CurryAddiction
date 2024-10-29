<script setup lang="ts">
import { computed, inject } from 'vue';
import Date from '@/views/atoms/Date.vue';

interface Props {
  readonly date: string;
}
const props = defineProps<Props>();

const dayjs = inject('$dayjs') as typeof import('dayjs');
const signUpDate = computed(() => dayjs(props.date).format('YYYY年M月'));
</script>

<template>
  <Date class="font-body text-sm text-sumi-900" :date :formatted-date="signUpDate" />
</template>
