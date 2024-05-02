<script setup lang="ts">
import { ref } from 'vue';

interface Props {
  displayName: string | null
}
const prop =defineProps<Props>()

const displayName = ref(prop.displayName)
</script>

<template>
  <input type="text" v-model="displayName" class="block w-full mt-3 text-sm border border-gray-300 p-3 rounded-lg" />
</template>
