<script setup lang="ts">
import StoreIcon from '@/views/atoms/icons/StoreIcon.vue'
import CommentIcon from '@/views/atoms/icons/CommentIcon.vue'
import CategoryIcon from '@/views/atoms/icons/CategoryIcon.vue'
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue'
import PhotoIcon from '@/views/atoms/icons/PhotoIcon.vue'
</script>
<template>
  <form action="" autocomplete="off" enctype="multipart/form-data" class="rounded-lg shadow px-20 py-8 font-body text-main">
    <h3 class="font-body flex justify-center text-xl font-semibold">新規投稿</h3>
    <div class="my-5">
      <label for="store_name" class="flex items-center gap-2.5"><StoreIcon class="text-gray-600" />店名</label>
      <input type="text" class="block mt-3 px-1 w-full border-b border-gray-200 outline-none" id="store_name" placeholder="お店の名前">
    </div>

    <div class="my-5">
      <label for="comment" class="flex items-center gap-2.5"><CommentIcon class="text-gray-600" />感想</label>
        <textarea name="comment" class="block mt-3 p-1 w-full h-24 border border-gray-200 rounded outline-none" id="comment" placeholder="味の特徴や感想を教えてください。"></textarea>
    </div>

    <div class="my-5">
      <label for="genre" class="flex items-center gap-2.5"><CategoryIcon class="text-gray-600" />ジャンル</label>
        <select name="genre" class="block mt-3 px-1 py-2 border rounded border-gray-200 outline-none" id="genre">
          <option value="">▼&nbsp;選択してください</option>
          <option value="">キーマカレー</option>
          <option value="">スリランカカレー</option>
          <option value="">インドカレー</option>
          <option value="">マトン系</option>
        </select>
    </div>

    <div class="my-5">
      <label for="region" class="flex items-center gap-2.5"><LocationIcon class="text-gray-600" />地方名</label>
        <select name="region" class="block mt-3 px-1 py-2 border rounded border-gray-200 outline-none" id="region">
          <option value="">▼&nbsp;選択してください</option>
          <option value="">北海道</option>
          <option value="">東北地方</option>
          <option value="">関東地方</option>
          <option value="">中部地方</option>
          <option value="">近畿地方</option>
          <option value="">中国地方</option>
          <option value="">四国地方</option>
          <option value="">九州地方</option>
        </select>
    </div>

    <div class="my-5">
      <label for="img" class="flex items-center gap-2.5"><PhotoIcon class="text-gray-600" />カレーの写真</label>
      <label for="img" class="mt-3 px-2 py-1 cursor-pointer rounded-sm flex items-center w-fit gap-2.5 border border-gray-200"><PhotoIcon class="text-gray-600" />画像を選択</label>
      <input type="file" class="hidden" name="img" id="img">
    </div>
    <div class="my-5">
      <label for="img">Googlemap埋め込み予定
      </label>
    </div>

    <button class="mx-auto p-3 block w-64 text-white rounded-full bg-sky-500">投稿する</button>
  </form>
</template>