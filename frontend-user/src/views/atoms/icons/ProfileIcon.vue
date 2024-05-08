<script setup lang="ts">
import { computed } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const isAccountPage = computed(() => router.currentRoute.value.meta.group === 'Account');
</script>
<template>
    <img src="../../../../public/icon/default_avatar.jpg" alt="" class="object-cover rounded-full bg-transparent">
</template>
