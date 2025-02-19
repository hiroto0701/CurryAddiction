<script setup lang="ts">
import { computed } from 'vue';
import { useStorageUrl } from '@/composables/useStorageUrl';
import type { PaginationStatus } from '@/types/post';
import CharacterIcon from '@/views/atoms/icons/CharacterIcon.vue';
import PaginationItem from '@/views/atoms/PaginationItem.vue';

const { getStorageUrl } = useStorageUrl();

interface Props {
  readonly paginationStatus: PaginationStatus | null;
}
const props = defineProps<Props>();

const visiblePages = computed(() => {
  if (!props.paginationStatus) return [];

  const BOTH_SIDE_PAGE_COUNT = 2;
  const MAX_VISIBLE_PAGES = 7;
  const currentPage = props.paginationStatus.current_page || 1;
  const lastPage = props.paginationStatus.last_page || 1;

  if (lastPage <= MAX_VISIBLE_PAGES) {
    return Array.from({ length: lastPage }, (_, i) => i + 1);
  }

  let pages: Array<number | string> = [];
  let startPage = Math.max(currentPage - BOTH_SIDE_PAGE_COUNT, 1);
  let endPage = Math.min(currentPage + BOTH_SIDE_PAGE_COUNT, lastPage);

  if (currentPage <= BOTH_SIDE_PAGE_COUNT + 1) {
    endPage = Math.min(MAX_VISIBLE_PAGES - 2, lastPage - 2);
  } else if (currentPage >= lastPage - BOTH_SIDE_PAGE_COUNT) {
    startPage = Math.max(3, lastPage - (MAX_VISIBLE_PAGES - 3));
  }

  if (startPage > 2) {
    pages.push(1);
    pages.push('...');
  } else {
    startPage = 1;
  }

  for (let i = startPage; i <= endPage; i++) {
    pages.push(i);
  }

  if (endPage < lastPage - 1) {
    pages.push('...');
    pages.push(lastPage);
  } else if (endPage === lastPage - 1) {
    pages.push(lastPage);
  }

  return pages;
});

const canPrev = computed((): boolean => {
  if (!props.paginationStatus) return false;
  const currentPage = props.paginationStatus.current_page || 1;
  return 1 < currentPage;
});

const canNext = computed((): boolean => {
  if (!props.paginationStatus) return false;
  const currentPage = props.paginationStatus.current_page || 1;
  const lastPage = props.paginationStatus.last_page || 1;
  return currentPage < lastPage;
});

const emit = defineEmits<{
  (e: 'change-page', visiblePage: number | string): void;
}>();

function doPrev(): void {
  if (canPrev.value && props.paginationStatus) {
    const currentPage = props.paginationStatus.current_page || 1;
    emit('change-page', currentPage - 1);
  }
}

function doNext(): void {
  if (canNext.value && props.paginationStatus) {
    const currentPage = props.paginationStatus.current_page || 1;
    emit('change-page', currentPage + 1);
  }
}
</script>

<template>
  <div v-if="paginationStatus">
    <p
      class="mb-2 flex items-center gap-2 font-body text-sm text-sumi-600"
      v-if="paginationStatus.total !== null"
    >
      <CharacterIcon :src="getStorageUrl('/illust/hungry-man.svg')" />
      全{{ paginationStatus.total }}件中 {{ paginationStatus.from || 0 }}件～{{
        paginationStatus.to || 0
      }}件を表示中
    </p>
    <p
      class="flex items-center gap-2 font-body text-sm text-sumi-600"
      v-if="paginationStatus.current_page !== null"
    >
      <CharacterIcon :src="getStorageUrl('/illust/hands-up-woman.svg')" />{{
        paginationStatus.current_page
      }}ページ目
    </p>
    <ul
      v-if="visiblePages.length"
      class="isolate mx-auto flex w-fit -space-x-px rounded-md shadow-sm"
      aria-label="Pagination"
    >
      <PaginationItem text="前へ" @click="doPrev" :disabled="!canPrev" />
      <PaginationItem
        v-for="(visiblePage, key) in visiblePages"
        :key="key"
        :active="paginationStatus.current_page === visiblePage"
        :text="visiblePage === '...' ? '...' : visiblePage"
        :disabled="visiblePage === '...'"
        @click="visiblePage !== '...' && emit('change-page', visiblePage)"
      />
      <PaginationItem text="次へ" @click="doNext" :disabled="!canNext" />
    </ul>
  </div>
</template>
