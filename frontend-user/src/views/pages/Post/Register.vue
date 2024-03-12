<script setup lang="ts">
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'
import CommentIcon from '@/views/atoms/icons/CommentIcon.vue'
import CategoryIcon from '@/views/atoms/icons/CategoryIcon.vue'
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue'
import PhotoIcon from '@/views/atoms/icons/PhotoIcon.vue'
import TextInputFormItem from '@/views/molecules/formItems/TextInputFormItem.vue'
import TextareaFormItem from '@/views/molecules/formItems/TextareaFormItem.vue'
import SelectBoxFormItem from '@/views/molecules/formItems/SelectBoxFormItem.vue'
import ImgUploadFormItem from '@/views/molecules/formItems/ImgUploadFormItem.vue'
import MapFormItem from '@/views/molecules/formItems/MapFormItem.vue'

</script>
<template>
  <form action="" autocomplete="off" enctype="multipart/form-data" class="rounded-lg shadow-sm border border-gray-200 px-20 py-8 font-body text-main">
    <h3 class="font-body flex justify-center text-xl font-semibold">新規投稿</h3>
    <TextInputFormItem label="店名" :required="true" :optional="false" :iconComponent="StoreIcon"  />
    <TextareaFormItem label="感想" :required="false" :optional="true" :iconComponent="CommentIcon" />
    <SelectBoxFormItem label="ジャンル" :required="true" :optional="false" :iconComponent="CategoryIcon" />
    <ImgUploadFormItem label="カレーの写真" :required="true" :optional="false" :iconComponent="PhotoIcon" />
    <MapFormItem label="位置情報" :required="true" :optional="false" :iconComponent="LocationIcon" />

    <!-- <div class="my-5">
      <label for="region" class="flex items-center gap-2">
        <LocationIcon class="text-gray-600" />
        地方名
        <span class="inline-flex items-center rounded bg-red-500 px-1 py-0.5 text-mini font-body font-normal text-white">必須</span>
      </label>
        <select name="region" class="block w-60 mt-3 p-2 text-sm border rounded-md border-gray-200" id="region">
          <option value="" hidden>選択してください</option>
          <option value="">北海道</option>
          <option value="">東北地方</option>
          <option value="">関東地方</option>
          <option value="">中部地方</option>
          <option value="">近畿地方</option>
          <option value="">中国地方</option>
          <option value="">四国地方</option>
          <option value="">九州地方</option>
        </select>
    </div> -->
    <button class="mx-auto p-3 block w-64 text-white rounded-full bg-sky-500">投稿する</button>
  </form>
</template>