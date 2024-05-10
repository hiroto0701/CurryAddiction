<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAccountStore } from '@/stores/account'

const router = useRouter()
const accountStore = useAccountStore()

const isAccountPage = computed(() => router.currentRoute.value.meta.group === 'Account');

const avatar = computed(() => {
	// return accountStore.state.avatar
	if (accountStore.state.avatar === null) {
		return '../../../../public/icon/default_avatar.jpg'
	} else {
		return accountStore.state.avatar
	}
})
</script>
<template>
	<img :src="avatar" alt="プロフィール画像" class="object-cover rounded-full bg-transparent">
</template>
