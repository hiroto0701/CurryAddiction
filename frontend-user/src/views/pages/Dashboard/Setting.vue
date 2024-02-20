<script setup lang="ts">
</script>
<template>
  <header class="flex items-center gap-3 text-xl text-main">
    <h1>設定</h1>
  </header>
  <div>
    <div class="mt-12">
      <div class="flex flex-col gap-11">
        
        <!-- プロフィール画像変更 -->
        <section class="overflow-hidden rounded-2xl border border-main-150 p-6 md:p-7">
          <div class="flex items-center gap-5">
            <div class="relative aspect-square w-16">
              <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full">
            </div>
            <label class="inline-flex h-10 items-center duration-500 gap-2 rounded-full border px-3.5 text-xs cursor-pointer hover:opacity-70">
              <span>プロフィール画像を変更</span>
            </label>
          </div>
        </section>

        <!-- 表示名変更 -->
        <section class="overflow-hidden rounded-2xl border border-main-150 p-6 md:p-7">
          <h2>表示名</h2>
          <div class="mt-3 text-sm text-utility">
            hiroto
          </div>
          <div class="mt-4">
            <button class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 text-sm py-3 px-4">
              変更する
            </button>
          </div>
        </section>

        <!-- お気に入りジャンル変更 -->
        <section class="overflow-hidden rounded-2xl border border-main-150 p-6 md:p-7">
          <h2>カレーのジャンル</h2>
          <div class="mt-3 text-sm text-utility">
            お好みのカレーのジャンルを登録できます。
          </div>
          <div class="mt-4">
            <button class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 text-sm py-3 px-4">
              変更する
            </button>
          </div>
        </section>

        <!-- 都道府県変更 -->
        <section class="overflow-hidden rounded-2xl border border-main-150 p-6 md:p-7">
          <h2>地方・都道府県</h2>
          <div class="mt-3 text-sm text-utility">
            表示する投稿の地域や都道府県を絞り込めます。
          </div>
          <div class="mt-4">
            <button class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 text-sm py-3 px-4">
              変更する
            </button>
          </div>
        </section>

        <!-- アカウント削除リンク -->
        <section class="flex justify-center">
          <p class="text-red-400 text-sm">アカウントの削除</p>
        </section>

      </div>
    </div>
  </div>
</template>