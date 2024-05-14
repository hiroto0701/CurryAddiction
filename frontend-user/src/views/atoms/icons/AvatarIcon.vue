<script setup lang="ts">
import { computed } from 'vue'
import { useAccountStore } from '@/stores/account'

interface Props {
	readonly preview?: string
}
defineProps<Props>()

const accountStore = useAccountStore()
const avatar = computed(() => {
	if (accountStore.state.avatar === null) {
		const defaultAvatar = '../../../../public/icon/default_avatar.jpg'
		return defaultAvatar
	} else {
		return accountStore.state.avatar
	}
})
</script>
<template>
	<img
		v-show="preview"
		:src="preview" 
		alt="プロフィール画像" 
		class="object-cover aspect-square h-full w-full rounded-full bg-transparent"
	>

	<img
		v-show="!preview"
		:src="avatar" 
		alt="プロフィール画像" 
		class="object-cover aspect-square h-full w-full rounded-full bg-transparent"
	>
</template>
