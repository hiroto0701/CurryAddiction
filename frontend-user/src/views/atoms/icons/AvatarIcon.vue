<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useAccountStore } from '@/stores/account'

const accountStore = useAccountStore()

const avatar = computed(() => {
	if (accountStore.state.avatar === null) {
		return '../../../../public/icon/default_avatar.jpg'
	} else {
		return accountStore.state.avatar
	}
})
</script>
<template>
	<img :src="avatar" alt="プロフィール画像" class="object-cover aspect-square rounded-full bg-transparent">
</template>
