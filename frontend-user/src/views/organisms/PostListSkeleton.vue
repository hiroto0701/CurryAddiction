<script setup lang="ts">
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue';
import CardSkeleton from '@/views/organisms/CardSkeleton.vue';
</script>

<template>
  <CardDisplayAreaLayout>
    <CardSkeleton />
    <CardSkeleton />
    <CardSkeleton />
  </CardDisplayAreaLayout>
</template>
