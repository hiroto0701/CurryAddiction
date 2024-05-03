<script setup lang="ts">
import { ref, computed } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useAccountFormStore } from '@/stores/account_form'
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue'
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue'
import GenreSettingButton from '@/views/molecules/buttons/GenreSettingButton.vue'
import RegionSettingButton from '@/views/molecules/buttons/RegionSettingButton.vue'
import ProfileImgBrowseItem from '@/views/molecules/browseItems/ProfileImgBrowseItem.vue'
import DisplayNameViewer from '@/views/pages/Dashboard/components/DisplayNameViewer.vue'
import DisplayNameEditor from '@/views/pages/Dashboard/components/DisplayNameEditor.vue'

const accountStore = useAccountStore()
const accountFormStore = useAccountFormStore()
const isEditingDisplayName = ref(false)
const errors = ref<Record<string, string[]>>({})
const displayName = ref<string | null>(accountStore.state.display_name)

const displayNameError = computed(() => 'display_name' in accountFormStore.state.errors)

const toggleEditMode = (): void => {
  isEditingDisplayName.value = !isEditingDisplayName.value
  // displayNameをrefで管理しているので入力キャンセル時にstateの値に戻す
  displayName.value = accountStore.state.display_name
  accountFormStore.resetErrors()
}

const validate = (): boolean => {
  errors.value = {}

  if (!displayName.value) {
    errors.value.display_name = ['表示名を入力してください']
  } 
  else if (displayName.value.length > 20) {
    errors.value.display_name = ['表示名は20字以下で設定してください']
  }

  if (Object.keys(errors.value).length > 0) {
    accountFormStore.setErrors(errors.value)
    return false
  }

  accountFormStore.resetErrors()
  return true
}

const doUpdate = async (displayName: string): Promise<void> => {
  if (validate()) {
    await accountFormStore.updateDisplayName(displayName)
    isEditingDisplayName.value = false
  }
}
</script>
<template>
  <DashboardContent title="設定">
    <!-- プロフィール画像変更 -->
    <DashboardSection>
      <div class="flex items-center gap-5">
        <ProfileImgBrowseItem class="w-16" />
        <label for="profile_img" class="inline-flex h-10 items-center duration-500 gap-2 rounded-full border px-3.5 text-xs cursor-pointer hover:opacity-70">
          プロフィール画像を変更
        </label>
        <input type="file" class="hidden" id="profile_img">
      </div>
    </DashboardSection>

    <!-- 表示名変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="表示名" />
      <DisplayNameViewer 
        v-if="!isEditingDisplayName"
        :display-name="accountStore.state.display_name"
        @edit="toggleEditMode" 
       />
      <DisplayNameEditor 
        v-else
        :is-error="displayNameError"
        :display-name="accountStore.state.display_name"
        v-model="displayName"
        @update="doUpdate(displayName)"
        @cancel="toggleEditMode"
      />
      <p v-show="accountFormStore.state.errors.display_name" class="font-body mt-3 text-xs text-red-400">
        {{ accountFormStore.state.errors?.display_name?.[0] }}
      </p>
    </DashboardSection>
    
    <!-- お気に入りジャンル変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="カレーのジャンル" />
      <SectionInfo text="お好みのカレーのジャンルを登録・変更できます。" class="mt-3 text-sm text-utility" />
      <GenreSettingButton class="inline-flex items-center justify-center border text-sm py-3 px-4 mt-4" />
    </DashboardSection>

    <!-- 都道府県変更 -->
    <DashboardSection>
      <DashboardSectionHeader title="地方・都道府県" />
      <SectionInfo text="表示する投稿の地方や都道府県を登録・変更できます。" class="mt-3 text-sm text-utility" />
      <RegionSettingButton class="inline-flex items-center justify-center border text-sm py-3 px-4 mt-4" />
    </DashboardSection>

    <!-- アカウント削除リンク -->
    <section class="flex justify-center">
      <a class="text-red-400 text-sm" href="#">アカウントの削除</a>
    </section>
  </DashboardContent>
</template>
