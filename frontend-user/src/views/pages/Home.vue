<script setup lang="ts">
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'
</script>
<template>
  <div class="grid grid-cols-1 gap-x-7 gap-y-12 xssm:grid-cols-2 md:grid-cols-3">
    <!-- card -->
    <div class="max-w-sm h-96 rounded-lg overflow-hidden border border-gray-200">
      <div class="w-full h-52">
        <img class="w-full h-full object-cover" src="https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg" alt="Sunset in the mountains">
      </div>
      <div class="flex justify-between h-fit px-3 py-1.5">
        <HeartIcon class="text-gray-400" />
        <ArchiveIcon class="text-gray-400" />
      </div>
      <div class="px-3 py-1 h-fit">
        <div class="font-bold text-md font-inter text-base">The Coldest Sunset</div>
      </div>
      <div class="px-3 py-1">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#ワンプレート</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#具沢山</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#パクチー</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#ワンプレート</span>
      </div>
    </div>

    <div class="max-w-sm h-96 rounded-lg overflow-hidden border border-gray-100">
      <div class="w-full h-52">
        <img class="w-full h-full object-cover" src="https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg" alt="Sunset in the mountains">
      </div>
      <div class="px-2 py-4">
        <div class="font-bold text-md font-inter text-base">The Coldest Sunset</div>
      </div>
      <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
      </div>
    </div>

    <div class="max-w-sm h-96 rounded-lg overflow-hidden border border-gray-100">
      <div class="w-full h-52">
        <img class="w-full h-full object-cover" src="https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg" alt="Sunset in the mountains">
      </div>
      <div class="px-2 py-4">
        <div class="font-bold text-md font-inter text-base">The Coldest Sunset</div>
      </div>
      <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
      </div>
    </div>

    <div class="max-w-sm rounded overflow-hidden shadow-lg">
      <img class="w-full" src="https://umaga.net/wp-content/uploads/2023/07/0728kubocurry_ec1-1200x900.jpg" alt="Sunset in the mountains">
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
        <p class="text-gray-700 text-base">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
        </p>
      </div>
      <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
      </div>
    </div>

    <div class="max-w-sm rounded overflow-hidden shadow-lg">
      <img class="w-full" src="https://arne.media/uploads/2021/05/BC34A4F4-B19D-4D4D-9845-7DA342864B7C-scaled-e1602049690983-1-675x506-1.jpg" alt="Sunset in the mountains">
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
        <p class="text-gray-700 text-base">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
        </p>
      </div>
      <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
      </div>
    </div>
  </div>
</template>