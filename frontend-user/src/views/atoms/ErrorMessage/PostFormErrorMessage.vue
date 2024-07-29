<script setup lang="ts">
interface Props {
  readonly fieldName: string
  readonly errors?: Record<string, string[]>
}
defineProps<Props>()
</script>
<template>
  <div>
    <p v-show="errors && errors[fieldName]" class="mt-1 font-body text-xs text-red-400">
      {{ errors && errors[fieldName]?.[0] }}
    </p>
  </div>
</template>
