<script setup lang="ts">
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue'
import ArchiveIcon from '@/views/atoms/icons/ArchiveIcon.vue'
import Card from '@/views/molecules/Card.vue'
</script>
<template>
  <div class="grid grid-cols-1 gap-x-7 gap-y-12 xssm:grid-cols-2 md:grid-cols-3">
    <!-- card -->
    <Card />

    <div class="h-80 rounded-lg overflow-hidden border border-gray-200">
      <div class="w-full h-52 cursor-pointer duration-300 hover:opacity-80">
        <img class="w-full h-full object-cover" src="https://kbc.co.jp/up/content/15/52/eeca759438ce78758b131724ff334a80f58efce0.jpg" alt="Sunset in the mountains">
      </div>

      <div class="flex flex-col justify-between h-full">
        <div class="flex justify-between h-fit px-3 py-1.5">
          <HeartIcon class="text-gray-700 cursor-pointer" />
          <ArchiveIcon class="text-gray-700 cursor-pointer" />
        </div>
        <div>
          <div class="px-3 h-fit flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
            <div class="font-normal font-body text-md">和平カレー</div>
          </div>
          <div class="px-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#福岡</span>
          </div>
        </div>
      </div>

    </div>


    <div class="h-80 rounded-lg overflow-hidden border border-gray-200">
      <div class="w-full h-52 cursor-pointer duration-300 hover:opacity-80">
        <img class="w-full h-full object-cover" src="https://cdn.sarah30.com/reviews/photos/000/431/919/medium/0f2ae3cf8e27eb4c0eb8e18928535e1b02f40014.jpg" alt="Sunset in the mountains">
      </div>

      <div class="flex flex-col justify-between h-full">
        <div class="flex justify-between h-fit px-3 py-1.5">
          <HeartIcon class="text-gray-700 cursor-pointer" />
          <ArchiveIcon class="text-gray-700 cursor-pointer" />
        </div>
        <div>
          <div class="px-3 h-fit flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
            <div class="font-normal font-body text-md">和平カレー</div>
          </div>
          <div class="px-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#福岡</span>
          </div>
        </div>
      </div>

    </div>


    <div class="h-80 rounded-lg overflow-hidden border border-gray-200">
      <div class="w-full h-52 cursor-pointer duration-300 hover:opacity-80">
        <img class="w-full h-full object-cover" src="https://local-best.jp/wp-content/themes/localbest/images/detail/jp/re/ref/fukuoka/other_49655.jpg" alt="Sunset in the mountains">
      </div>

      <div class="flex flex-col justify-between h-full">
        <div class="flex justify-between h-fit px-3 py-1.5">
          <HeartIcon class="text-gray-700 cursor-pointer" />
          <ArchiveIcon class="text-gray-700 cursor-pointer" />
        </div>
        <div>
          <div class="px-3 h-fit flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
            <div class="font-normal font-body text-md">和平カレー</div>
          </div>
          <div class="px-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#福岡</span>
          </div>
        </div>
      </div>

    </div>


    <div class="h-80 rounded-lg overflow-hidden border border-gray-200">
      <div class="w-full h-52 cursor-pointer duration-300 hover:opacity-80">
        <img class="w-full h-full object-cover" src="https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg" alt="Sunset in the mountains">
      </div>

      <div class="flex flex-col justify-between h-full">
        <div class="flex justify-between h-fit px-3 py-1.5">
          <HeartIcon class="text-gray-700 cursor-pointer" />
          <ArchiveIcon class="text-gray-700 cursor-pointer" />
        </div>
        <div>
          <div class="px-3 h-fit flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
            <div class="font-normal font-body text-md">和平カレー</div>
          </div>
          <div class="px-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#福岡</span>
          </div>
        </div>
      </div>

    </div>


    <div class="h-80 rounded-lg overflow-hidden border border-gray-200">
      <div class="w-full h-52 cursor-pointer duration-300 hover:opacity-80">
        <img class="w-full h-full object-cover" src="https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg" alt="Sunset in the mountains">
      </div>

      <div class="flex flex-col justify-between h-full">
        <div class="flex justify-between h-fit px-3 py-1.5">
          <HeartIcon class="text-gray-700 cursor-pointer" />
          <ArchiveIcon class="text-gray-700 cursor-pointer" />
        </div>
        <div>
          <div class="px-3 h-fit flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
            <div class="font-normal font-body text-md">和平カレー</div>
          </div>
          <div class="px-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 aspect-square text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#福岡</span>
          </div>
        </div>
      </div>

    </div>

  </div>
</template>