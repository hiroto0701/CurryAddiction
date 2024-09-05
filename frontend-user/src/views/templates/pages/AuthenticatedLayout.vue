<script setup lang="ts">
import { onMounted } from 'vue';
import { useAccountStore } from '@/stores/account';
import { useCurryGenreStore } from '@/stores/curry_genre';
import MeatballDropDown from '@/views/molecules/dropdown/MeatballDropDown.vue';
import ScrollToTopButton from '@/views/molecules/buttons/ScrollToTopButton.vue';

const accountStore = useAccountStore();
const curryGenreStore = useCurryGenreStore();

// カレーのジャンル情報を取得
onMounted(() => {
  curryGenreStore.fetchGenres();
});
</script>
<template>
  <RouterView />
  <MeatballDropDown
    class="z-10"
    :key="accountStore.state.avatar_url ?? ''"
    :handle-name="accountStore.state.handle_name"
    :avatar-url="accountStore.state.avatar_url"
  />
  <ScrollToTopButton class="z-10" />
</template>
