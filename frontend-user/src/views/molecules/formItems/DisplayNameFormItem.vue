<script setup lang="ts">
import { ref } from 'vue';

// interface Props {
//   initialValue: string | null
// }
// defineProps<Props>()

// const displayName = ref(initialValue)
const displayName = ref('test')
</script>

<template>
  <input type="text" v-model="displayName" class="block w-full mt-3 text-sm border border-gray-300 p-3 rounded-lg" />
</template>
