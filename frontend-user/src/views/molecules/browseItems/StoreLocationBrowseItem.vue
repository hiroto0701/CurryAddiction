<script setup lang="ts">
import { computed, inject } from 'vue'
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue'
import Date from '@/views/atoms/Date.vue'

interface Props {
  readonly location: string
  readonly date: string
}
const props = defineProps<Props>()

const dayjs = inject('$dayjs') as typeof import('dayjs')
const postDate = computed(() => dayjs(props.date).format('YYYY年M月D日'))
</script>
<template>
  <div class="px-3 py-1 flex items-center gap-2.5 relative">
    <LocationIcon />
    <span
      class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700"
    >
      {{ location }}
    </span>
    <Date :date="postDate" />
  </div>
</template>
