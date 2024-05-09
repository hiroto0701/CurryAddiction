<script setup lang="ts">
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAccountStore } from '@/stores/account'

const router = useRouter()
const accountStore = useAccountStore()

const isAccountPage = computed(() => router.currentRoute.value.meta.group === 'Account');

const avatarPath = computed(() => {
	return accountStore.state.profile_path
})

onMounted(() =>{
	console.table(accountStore.state.profile_path)
})
</script>
<template>
    <img :src="avatarPath" alt="" class="object-cover rounded-full bg-transparent">
</template>
