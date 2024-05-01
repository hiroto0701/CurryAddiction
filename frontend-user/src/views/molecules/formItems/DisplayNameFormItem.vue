<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps({
  initialValue: {
    type: String,
    required: true,
  },
});

const displayName = ref(props.initialValue);
</script>

<template>
  <input type="text" v-model="displayName" />
</template>
