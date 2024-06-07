<script setup lang="ts">
import { ref, watch } from 'vue'
import { usePostFormStore } from '@/stores/post_form'
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'
import CommentIcon from '@/views/atoms/icons/CommentIcon.vue'
import CategoryIcon from '@/views/atoms/icons/CategoryIcon.vue'
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue'
import PhotoIcon from '@/views/atoms/icons/PhotoIcon.vue'
import CreatePostButton from '@/views/molecules/buttons/CreatePostButton.vue'
import DeletePostImgButton from '@/views/molecules/buttons/DeletePostImgButton.vue'
import TextInputFormItem from '@/views/molecules/formItems/TextInputFormItem.vue'
import TextareaFormItem from '@/views/molecules/formItems/TextareaFormItem.vue'
import SelectBoxFormItem from '@/views/molecules/formItems/SelectBoxFormItem.vue'
import PostImgUploadFormItem from '@/views/molecules/formItems/PostImgUploadFormItem.vue'
import MapFormItem from '@/views/molecules/formItems/MapFormItem.vue'
import PostCreateConfirmModal from '@/views/molecules/modals/PostCreateConfirmModal.vue'
import RegisterForm from '@/views/templates/forms/RegisterForm.vue'

const postFormStore = usePostFormStore()

const storeName = ref<string>('')
const comment = ref<string>('')
const modalOpen = ref<boolean>(false)
const storeNameError = ref<boolean>(false)
const fileInfo = ref<File>()
const preview = ref<string | undefined>()

const genre_id = ref<number | undefined>(1)

function openModal(): void {
  modalOpen.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal(): void {
  modalOpen.value = false
  document.body.style.overflow = 'auto'
}

function handleFileSelected(target: HTMLInputElement) {
  if (target.files && target.files.length > 0) {
    fileInfo.value = target.files[0]
    preview.value = URL.createObjectURL(fileInfo.value)
  }
}

function resetPreview(): void {
  fileInfo.value = undefined
  preview.value = undefined
}

async function doCreate() {
  const isValid = postFormStore.validate(
    storeName.value,
    comment.value,
    genre_id.value,
    fileInfo.value,
    0.1, // latitude
    0.1 // longitude
  )

  if (!isValid) {
    closeModal()
    return false
  }

  try {
    await postFormStore.create({
      store_name: storeName.value,
      comment: comment.value,
      genre_id: genre_id.value,
      post_img: fileInfo.value
    })
  } finally {
    closeModal()
  }
}

watch<string, false>(storeName, (newValue) => {
  storeNameError.value = !newValue.length || newValue.length > 30
})
</script>
<template>
  <RegisterForm title="新規投稿" @submit.prevent="doCreate">
    <TextInputFormItem
      label="店名"
      :required="true"
      :optional="false"
      :iconComponent="StoreIcon"
      :is-error="storeNameError"
      placeholder="お店の名前"
      v-model="storeName"
    />
    <TextareaFormItem
      label="感想"
      :required="false"
      :optional="true"
      :iconComponent="CommentIcon"
      v-model="comment"
    />
    <SelectBoxFormItem
      label="ジャンル"
      :required="true"
      :optional="false"
      :iconComponent="CategoryIcon"
    />
    <div class="flex items-end">
      <PostImgUploadFormItem
        label="カレーの写真"
        :required="true"
        :optional="false"
        :iconComponent="PhotoIcon"
        @upload="handleFileSelected"
      />
      <DeletePostImgButton v-show="preview" @click="resetPreview" />
    </div>
    <div v-show="preview" class="w-80 mt-8 h-fit mx-auto border border-gray-200">
      <img class="w-full object-fit" :src="preview" alt="投稿画像" />
    </div>
    <MapFormItem
      label="位置情報"
      :required="true"
      :optional="false"
      :iconComponent="LocationIcon"
    />
    <CreatePostButton class="mx-auto mt-8 block p-3 w-52" text="投稿する" @click="openModal" />

    <Teleport to="body">
      <PostCreateConfirmModal
        v-show="modalOpen"
        @commit="doCreate"
        @cancel="closeModal"
        :closeModal
      />
    </Teleport>
  </RegisterForm>
</template>
