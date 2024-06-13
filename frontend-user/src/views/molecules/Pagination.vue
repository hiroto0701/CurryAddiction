<script setup lang="ts">
import { type PaginationStatus } from '@/stores/post_index'
interface Props {
  readonly paginationStatus: PaginationStatus
}
defineProps<Props>()
</script>
<template>
  <div>
    <p class="font-body text-sumi-900 text-sm">
      全{{ paginationStatus.total }}件中 {{ paginationStatus.from }}件～{{
        paginationStatus.to
      }}件を表示中
    </p>
    <p class="font-body text-sumi-900 text-sm">{{ paginationStatus.current_page }}ページ目</p>
  </div>
</template>
