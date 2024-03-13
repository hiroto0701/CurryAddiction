<script setup lang="ts">
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'
import CommentIcon from '@/views/atoms/icons/CommentIcon.vue'
import CategoryIcon from '@/views/atoms/icons/CategoryIcon.vue'
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue'
import PhotoIcon from '@/views/atoms/icons/PhotoIcon.vue'
import RegisterForm from '@/views/templates/forms/RegisterForm.vue'
import TextInputFormItem from '@/views/molecules/formItems/TextInputFormItem.vue'
import TextareaFormItem from '@/views/molecules/formItems/TextareaFormItem.vue'
import SelectBoxFormItem from '@/views/molecules/formItems/SelectBoxFormItem.vue'
import ImgUploadFormItem from '@/views/molecules/formItems/ImgUploadFormItem.vue'
import MapFormItem from '@/views/molecules/formItems/MapFormItem.vue'

</script>
<template>
  <RegisterForm title="新規投稿">
    <TextInputFormItem label="店名" :required="true" :optional="false" :iconComponent="StoreIcon"  />
    <TextareaFormItem label="感想" :required="false" :optional="true" :iconComponent="CommentIcon" />
    <SelectBoxFormItem label="ジャンル" :required="true" :optional="false" :iconComponent="CategoryIcon" />
    <ImgUploadFormItem label="カレーの写真" :required="true" :optional="false" :iconComponent="PhotoIcon" />
    <MapFormItem label="位置情報" :required="true" :optional="false" :iconComponent="LocationIcon" />
    <button class="mx-auto font-body p-3 block w-52 text-white rounded-full bg-sky-500">投稿する</button>
  </RegisterForm>
</template>