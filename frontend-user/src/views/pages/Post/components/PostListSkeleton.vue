<script setup lang="ts">
import PhotoIcon from '@/views/atoms/icons/PhotoIcon.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'
</script>
<template>
  <CardDisplayAreaLayout>
    <div class="h-80 rounded-lg overflow-hidden border border-gray-200 animate-pulse">
      <!-- 画像 -->
      <div class="w-full h-52 border-gray-200">
        <div
          class="flex justify-center items-center bg-slate-200 w-full h-full border-b border-gray-200"
        >
          <PhotoIcon class="text-slate-400 w-10" />
        </div>
      </div>

      <div class="flex flex-col justify-between h-28 py-2 animate-pulse">
        <!-- 画像下のアイコン部分 -->
        <div class="flex justify-between h-fit px-1.5 py-1">
          <div class="w-20 h-3 rounded-full flex items-center justify-center bg-slate-200"></div>
          <div class="w-20 h-3 rounded-full flex items-center justify-center bg-slate-200"></div>
        </div>

        <!-- 店名 -->
        <div class="px-3 py-1 h-fit flex items-center gap-2.5">
          <div class="w-6 h-6 bg-slate-200 rounded-full"></div>
          <div class="w-28 h-3 bg-slate-200 rounded-full"></div>
        </div>

        <!-- 地名 -->
        <div class="flex justify-between items-center mr-2">
          <div class="px-3 py-1 flex items-center gap-2.5 relative">
            <div class="w-6 h-6 bg-slate-200 rounded-full"></div>
            <div class="w-16 h-3 bg-slate-200 rounded-full"></div>
          </div>

          <!-- 日付 -->
          <div class="w-20 h-3 bg-slate-200 rounded-full"></div>
        </div>
      </div>
    </div>
  </CardDisplayAreaLayout>
</template>
