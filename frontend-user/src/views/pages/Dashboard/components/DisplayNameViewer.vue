<script setup lang="ts">
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue'
import EditDisplayNameButton from '@/views/molecules/buttons/EditDisplayNameButton.vue'

interface Props {
  readonly displayName: null | string
}

defineProps<Props>()

const emit = defineEmits<{
  (e: 'edit'): void
}>()
</script>
<template>
  <DisplayNameBrowseItem :display-name class="mt-3 text-sm text-utility" />
  <EditDisplayNameButton
    class="inline-flex items-center justify-center border text-sm py-3 px-4 mt-4"
    @click="emit('edit')"
  />
</template>
