<script setup lang="ts">
import { ref } from 'vue';
import { useCommonStore } from '@/stores/common';
import { usePostForm } from '@/composables/functions/usePostForm';
import {
  convertPrefectureNameToPrefId,
  convertPrefectureNameToRegionId
} from '@/constant/prefecture';
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue';
import CommentIcon from '@/views/atoms/icons/CommentIcon.vue';
import GenreIcon from '@/views/atoms/icons/GenreIcon.vue';
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue';
import PhotoIcon from '@/views/atoms/icons/PhotoIcon.vue';
import CreatePostButton from '@/views/molecules/buttons/CreatePostButton.vue';
import StoreNameFormItem from '@/views/molecules/formItems/StoreNameFormItem.vue';
import CommentFormItem from '@/views/molecules/formItems/CommentFormItem.vue';
import SelectBoxFormItem from '@/views/molecules/formItems/SelectBoxFormItem.vue';
import PostImgUploadFormItem from '@/views/molecules/formItems/PostImgUploadFormItem.vue';
import MapFormItem from '@/views/molecules/formItems/MapFormItem.vue';
import ActionConfirmModal from '@/views/molecules/modals/ActionConfirmModal.vue';
import RegisterForm from '@/views/templates/forms/RegisterForm.vue';

interface StructuredAddress {
  postcode: string;
  prefecture: string;
  municipality: string;
  ward?: string;
  district: string;
}

const commonStore = useCommonStore();
const {
  storeName,
  comment,
  genreId,
  genreOptions,
  preview,
  latitude,
  longitude,
  officialName,
  formattedAddress,
  postcode,
  prefecture,
  municipality,
  ward,
  district,
  regionId,
  prefectureId,
  storeNameError,
  reactiveErrors,
  handleFileSelected,
  resetPreview,
  submitForm
} = usePostForm();

const open = ref<boolean>(false);

function openModal(): void {
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  open.value = false;
  document.body.style.overflow = 'auto';
}

function getLocationValue(location: { lat: number; lng: number }): void {
  latitude.value = location.lat;
  longitude.value = location.lng;
}

function getLocationInfo(
  official_name: string,
  formatted_address: string,
  structuredAddress: StructuredAddress
): void {
  officialName.value = official_name;
  formattedAddress.value = formatted_address;
  postcode.value = structuredAddress.postcode;
  prefecture.value = structuredAddress.prefecture;
  municipality.value = structuredAddress.municipality;
  ward.value = structuredAddress?.ward;
  district.value = structuredAddress.district;
  regionId.value = convertPrefectureNameToRegionId(prefecture.value);
  prefectureId.value = convertPrefectureNameToPrefId(prefecture.value);
}

async function doCreate() {
  try {
    const success = await submitForm();
    if (success) {
      closeModal();
    }
  } catch (error) {
    commonStore.setErrorMessage('投稿に失敗しました');
    setTimeout(() => {
      commonStore.clearErrorMessage();
    }, 4000);
    console.error('投稿に失敗しました:', error);
  } finally {
    closeModal();
    window.scrollTo({
      top: 0
    });
  }
}
</script>
<template>
  <RegisterForm>
    <StoreNameFormItem
      label="店名"
      :required="true"
      :iconComponent="StoreIcon"
      :is-error="storeNameError"
      :errors="reactiveErrors"
      placeholder="お店の名前"
      v-model="storeName"
    />
    <CommentFormItem
      label="感想"
      :required="false"
      :iconComponent="CommentIcon"
      :errors="reactiveErrors"
      v-model="comment"
    />
    <SelectBoxFormItem
      label="ジャンル"
      :required="true"
      :errors="reactiveErrors"
      :iconComponent="GenreIcon"
      :options="genreOptions"
      v-model="genreId"
    />
    <div class="flex items-end">
      <PostImgUploadFormItem
        label="カレーの写真"
        :required="true"
        :iconComponent="PhotoIcon"
        :img-preview="preview"
        :errors="reactiveErrors"
        @upload="handleFileSelected"
        @delete="resetPreview"
      />
    </div>
    <div v-show="preview" class="mx-auto mt-8 h-fit w-80 border border-gray-200">
      <img class="object-fit w-full" :src="preview" alt="投稿画像" />
    </div>
    <MapFormItem
      label="位置情報"
      :required="true"
      :iconComponent="LocationIcon"
      :errors="reactiveErrors"
      placeholder="場所を検索"
      @update:location="getLocationValue"
      @update:location-info="getLocationInfo"
    />
    <CreatePostButton class="mx-auto mt-8 block w-52 p-3" text="投稿する" @click="openModal" />

    <Teleport to="body">
      <ActionConfirmModal
        v-show="open"
        :is-loading="commonStore.state.apiLoading"
        modal-title="この内容で投稿しますか？"
        button-text="投稿する"
        @commit="doCreate"
        @cancel="closeModal"
        :closeModal
      />
    </Teleport>
  </RegisterForm>
</template>
