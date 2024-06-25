<script setup lang="ts">
import axios from 'axios'
import { useAccountStore } from '@/stores/account'
import { useRoute } from 'vue-router'
import { onMounted } from 'vue'
import Card from '@/views/molecules/card/Card.vue'
import GotoSettingPageButton from '@/views/molecules/buttons/GotoSettingPageButton.vue'
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue'
import HandleNameBrowseItem from '@/views/molecules/browseItems/HandleNameBrowseItem.vue'
import AvatarBrowseItem from '@/views/molecules/browseItems/AvatarBrowseItem.vue'
import UserAnalytics from '@/views/molecules/UserAnalytics.vue'
import CardDisplayAreaLayout from '@/views/templates/CardDisplayAreaLayout.vue'

const accountStore = useAccountStore()
const route = useRoute()

onMounted(async () => {
  const response = await axios.get(`/api/${route.params.username}`)
  console.log(response.data.data)
})
</script>
<template>
  <div class="mb-12 overflow-hidden rounded-2xl border p-6 md:p-7">
    <div class="flex items-center gap-3.5 py-6">
      <AvatarBrowseItem class="w-24" />
      <div class="flex-1 leading-normal">
        <DisplayNameBrowseItem
          :display-name="accountStore.state.display_name"
          class="break-all text-md text-sumi-900"
        />
        <HandleNameBrowseItem :handle-name="accountStore.state.handle_name" />
      </div>
      <GotoSettingPageButton text="設定" />
    </div>
    <UserAnalytics />
  </div>
  <CardDisplayAreaLayout>
    <!-- <Card
      :src="'https://pbs.twimg.com/media/Fe6MtHRVUAQqqmF.jpg'"
      store-name="和平カレー"
      location="福岡"
      date="2024年12月24日"
    />
    <Card
      :src="'https://livedoor.blogimg.jp/mantaro_club/imgs/e/a/eae0ac07.jpg'"
      store-name="ダメヤ"
      location="福岡"
      date="2024年12月24日"
    />
    <Card
      :src="'https://umaga.net/wp-content/uploads/2021/08/DSC02736-1200x798.jpg'"
      store-name="ヌワラエリヤ"
      location="福岡"
      date="2024年12月24日"
    />
    <Card
      :src="'https://img.rurubu.jp/img_srw/andmore/images/0000239745/yMJCHzJxBlvH94UqlUlXon7iIQyj6FZonEaXOitI.jpeg'"
      store-name="クボカリー"
      location="福岡"
      date="2024年12月24日"
    />
    <Card
      :src="'https://japanesecurry.net/spicy_cms/wp-content/uploads/2019/12/afterglow-520x390.jpg'"
      store-name="アフターグロウ"
      location="福岡"
      date="2024年12月24日"
    />
    <Card
      :src="'https://kbc.co.jp/up/content/15/52/f9d7a4913873066e0ec8713aa5fcb3180add5b38.jpg'"
      store-name="Rスリランカ"
      location="福岡"
      date="2024年12月24日"
    /> -->
  </CardDisplayAreaLayout>
</template>
