<script setup lang="ts">
import DisplayNameFormItem from '@/views/molecules/formItems/DisplayNameFormItem.vue'
import UpdateButton from '@/views/molecules/buttons/UpdateButton.vue'
import CancelButton from '@/views/molecules/buttons/CancelButton.vue'

const emits = defineEmits<{
  (e: 'cancel'): void
}>()
</script>
<template>
  <DisplayNameFormItem />
  <UpdateButton class="inline-flex items-center justify-center border text-sm py-3 px-4 mt-4 mr-2" />
  <CancelButton 
    class="inline-flex items-center justify-center border text-sm py-3 px-4 mt-4" 
    @click="emits('cancel')"
  />
</template>
