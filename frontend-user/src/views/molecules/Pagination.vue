<script setup lang="ts">
import { computed } from 'vue'
import type { PaginationStatus } from '@/composables/useFetchPostData'
import CharacterIcon from '@/views/atoms/icons/character/CharacterIcon.vue'
import PageItem from '@/views/atoms/PageItem.vue'

interface Props {
  readonly paginationStatus: PaginationStatus | null
}
const props = defineProps<Props>()

const visiblePages = computed(() => {
  if (!props.paginationStatus) return []

  const BOTH_SIDE_PAGE_COUNT = 2
  const MAX_VISIBLE_PAGES = 7
  const currentPage = props.paginationStatus.current_page || 1
  const lastPage = props.paginationStatus.last_page || 1

  if (lastPage <= MAX_VISIBLE_PAGES) {
    return Array.from({ length: lastPage }, (_, i) => i + 1)
  }

  let pages: Array<number | string> = []
  let startPage = Math.max(currentPage - BOTH_SIDE_PAGE_COUNT, 1)
  let endPage = Math.min(currentPage + BOTH_SIDE_PAGE_COUNT, lastPage)

  if (currentPage <= BOTH_SIDE_PAGE_COUNT + 1) {
    endPage = Math.min(MAX_VISIBLE_PAGES - 2, lastPage - 2)
  } else if (currentPage >= lastPage - BOTH_SIDE_PAGE_COUNT) {
    startPage = Math.max(3, lastPage - (MAX_VISIBLE_PAGES - 3))
  }

  if (startPage > 2) {
    pages.push(1)
    pages.push('...')
  } else {
    startPage = 1
  }

  for (let i = startPage; i <= endPage; i++) {
    pages.push(i)
  }

  if (endPage < lastPage - 1) {
    pages.push('...')
    pages.push(lastPage)
  } else if (endPage === lastPage - 1) {
    pages.push(lastPage)
  }

  return pages
})

const canPrev = computed((): boolean => {
  if (!props.paginationStatus) return false
  const currentPage = props.paginationStatus.current_page || 1
  return 1 < currentPage
})

const canNext = computed((): boolean => {
  if (!props.paginationStatus) return false
  const currentPage = props.paginationStatus.current_page || 1
  const lastPage = props.paginationStatus.last_page || 1
  return currentPage < lastPage
})

const emit = defineEmits<{
  (e: 'change-page', visiblePage: number | string): void
}>()

function doPrev(): void {
  if (canPrev.value && props.paginationStatus) {
    const currentPage = props.paginationStatus.current_page || 1
    emit('change-page', currentPage - 1)
  }
}

function doNext(): void {
  if (canNext.value && props.paginationStatus) {
    const currentPage = props.paginationStatus.current_page || 1
    emit('change-page', currentPage + 1)
  }
}
</script>

<template>
  <div v-if="paginationStatus">
    <p
      class="font-body text-sumi-600 text-sm flex items-center gap-2 mb-2"
      v-if="paginationStatus.total !== null"
    >
      <CharacterIcon src="http://localhost:9000/local-curry_addiction/illust/hungry-man.svg" />
      全{{ paginationStatus.total }}件中 {{ paginationStatus.from || 0 }}件～{{
        paginationStatus.to || 0
      }}件を表示中
    </p>
    <p
      class="font-body text-sumi-600 text-sm flex items-center gap-2"
      v-if="paginationStatus.current_page !== null"
    >
      <CharacterIcon
        src="http://localhost:9000/local-curry_addiction/illust/hands-up-woman.svg"
      />{{ paginationStatus.current_page }}ページ目
    </p>
    <ul
      v-if="visiblePages.length"
      class="isolate flex -space-x-px rounded-md shadow-sm w-fit mx-auto"
      aria-label="Pagination"
    >
      <PageItem text="前へ" @click="doPrev" :disabled="!canPrev" />
      <PageItem
        v-for="(visiblePage, key) in visiblePages"
        :key="key"
        :active="paginationStatus.current_page === visiblePage"
        :text="visiblePage === '...' ? '...' : visiblePage"
        :disabled="visiblePage === '...'"
        @click="visiblePage !== '...' && emit('change-page', visiblePage)"
      />
      <PageItem text="次へ" @click="doNext" :disabled="!canNext" />
    </ul>
  </div>
</template>
