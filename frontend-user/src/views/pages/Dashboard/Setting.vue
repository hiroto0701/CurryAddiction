<script setup lang="ts">
import { useAccountStore } from '@/stores/account'
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue'
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue'
import ChangeDisplayNameButton from '@/views/molecules/buttons/ChangeDisplayNameButton.vue'
import GenreSettingButton from '@/views/molecules/buttons/GenreSettingButton.vue'
import RegionSettingButton from '@/views/molecules/buttons/RegionSettingButton.vue'
import DisplayNameBrowseItem from '@/views/molecules/browseItems/DisplayNameBrowseItem.vue'

const accountStore = useAccountStore()
</script>
<template>
  <DashboardContent title="設定">
    <!-- プロフィール画像変更 -->
    <DashboardSection>
      <div class="flex items-center gap-5">
        <div class="relative aspect-square w-16">
          <img src="https://placehold.jp/64x64.png" class="h-full w-full rounded-full">
        </div>
        <label class="inline-flex h-10 items-center duration-500 gap-2 rounded-full border px-3.5 text-xs cursor-pointer hover:opacity-70 hover:bg-slate-50">
          <span>プロフィール画像を変更</span>
        </label>
      </div>
    </DashboardSection>

    <!-- 表示名変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="表示名" />
      <DisplayNameBrowseItem :value="accountStore.state.display_name" class="mt-3 text-sm text-utility" />
      <ChangeDisplayNameButton class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 hover:bg-slate-50 text-sm py-3 px-4 mt-4" />
    </DashboardSection>
    
    <!-- お気に入りジャンル変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="カレーのジャンル" />
      <SectionInfo text="お好みのカレーのジャンルを登録・変更できます。" class="mt-3 text-sm text-utility" />
      <GenreSettingButton class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 hover:bg-slate-50 text-sm py-3 px-4 mt-4" />
    </DashboardSection>

    <!-- 都道府県変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="地方・都道府県" />
      <SectionInfo text="表示する投稿の地方や都道府県を登録・変更できます。" class="mt-3 text-sm text-utility" />
      <RegionSettingButton class="inline-flex items-center justify-center duration-500 text-main border rounded-full hover:opacity-70 hover:bg-slate-50 text-sm py-3 px-4 mt-4" />
    </DashboardSection>

    <!-- アカウント削除リンク -->
    <section class="flex justify-center">
      <a class="text-red-400 text-sm" href="#">アカウントの削除</a>
    </section>
  </DashboardContent>
</template>
