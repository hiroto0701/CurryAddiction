<script setup lang="ts">
import type { Component } from 'vue';
import FormErrorMessage from '@/views/atoms/ErrorMessage/FormErrorMessage.vue';
import FormLayout from '@/views/templates/FormLayout.vue';
import DeletePostImgButton from '@/views/molecules/buttons/DeletePostImgButton.vue';

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly iconComponent: Component;
  readonly imgPreview?: string;
  readonly errors?: Record<string, string[]>;
}
defineProps<Props>();

function handleFileChange(event: Event) {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    emits('upload', target);
  }
}

const emits = defineEmits<{
  (e: 'upload', target: HTMLInputElement): void;
  (e: 'delete'): void;
}>();
</script>

<template>
  <FormLayout :label :required :iconComponent>
    <div class="flex gap-2">
      <div>
        <label
          for="post_img"
          class="flex w-fit cursor-pointer items-center gap-2 rounded-md border border-gray-200 p-2 font-body text-sm text-sumi-900 hover:bg-slate-100"
          tabindex="0"
        >
          <component :is="iconComponent" class="text-sumi-900" />
          画像を選択
        </label>
        <input
          type="file"
          class="hidden"
          id="post_img"
          @change="handleFileChange"
          accept="image/png, image/jpeg"
        />
      </div>
      <DeletePostImgButton v-show="imgPreview" @click="emits('delete')" />
    </div>
    <FormErrorMessage class="mt-1" field-name="postImg" :errors />
  </FormLayout>
</template>
