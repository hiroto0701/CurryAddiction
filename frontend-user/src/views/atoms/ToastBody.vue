<script setup lang="ts">
import type { Component } from 'vue';
import { tv } from 'tailwind-variants';

interface Props {
  readonly message: null | string;
  readonly iconComponent: null | Component;
}
defineProps<Props>();

const errorIcon = tv({
  base: 'rounded-full bg-white'
});

const errorMessage = tv({
  base: 'font-body text-sm text-white'
});
</script>
<template>
  <component :is="iconComponent" :class="errorIcon()" />
  <p :class="errorMessage()">{{ message }}</p>
</template>
