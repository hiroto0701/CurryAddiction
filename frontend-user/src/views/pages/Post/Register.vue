<script setup lang="ts">
</script>
<template>
  <form action="">
    <div>
      <label for="store_name">店名
        <input type="text" id="store_name" placeholder="お店の名前">
      </label>
    </div>
    <div>
      <label for="comment">感想
        <textarea name="comment" id="comment" placeholder="味の特徴や感想を教えてください。"></textarea>
      </label>
    </div>
    <div>
      <label for="genre">ジャンル
        <select name="genre" id="genre">
          <option value="">選択してください</option>
          <option value="">キーマカレー</option>
          <option value="">スリランカカレー</option>
          <option value="">インドカレー</option>
          <option value="">マトン系</option>
        </select>
      </label>
    </div>
    <div>
      <label for="region">地方名
        <select name="region" id="region">
          <option value="">選択してください</option>
          <option value="">北海道</option>
          <option value="">東北地方</option>
          <option value="">関東地方</option>
          <option value="">中部地方</option>
          <option value="">近畿地方</option>
          <option value="">中国地方</option>
          <option value="">四国地方</option>
          <option value="">九州地方</option>
        </select>
      </label>
    </div>
    <div>
      <label for="img">カレーの写真
        <input type="file" name="img" id="img">
      </label>
    </div>
    <div>
      <label for="img">Googlemap埋め込み予定
      </label>
    </div>
  </form>
</template>