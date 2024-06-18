<script setup lang="ts">
interface Props {
  readonly title: string
}
defineProps<Props>()
</script>
<template>
  <form
    autocomplete="off"
    enctype="multipart/form-data"
    class="rounded-lg border border-gray-200 px-20 py-8 font-body"
  >
    <!-- <div v-if="canBack" class="d-flex justify-content-end">
      <back-button @click="$emit('back')" />
    </div> -->
    <h3 class="font-body flex justify-center text-2xl font-medium text-sumi-900">{{ title }}</h3>
    <slot />
  </form>
</template>
