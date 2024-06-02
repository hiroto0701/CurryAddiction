<script setup lang="ts">
import { ref, computed, onUnmounted } from 'vue'
import { useAccountStore } from '@/stores/account'
import { useAccountFormStore } from '@/stores/account_form'
import { useCommonStore } from '@/stores/common'
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue'
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue'
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue'
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue'
import GenreSettingButton from '@/views/molecules/buttons/GenreSettingButton.vue'
import RegionSettingButton from '@/views/molecules/buttons/RegionSettingButton.vue'
import AvatarBrowseItem from '@/views/molecules/browseItems/AvatarBrowseItem.vue'
import DisplayNameViewer from '@/views/pages/Dashboard/components/DisplayNameViewer.vue'
import DisplayNameEditor from '@/views/pages/Dashboard/components/DisplayNameEditor.vue'
import AvatarEditor from '@/views/pages/Dashboard/components/AvatarEditor.vue'

const accountStore = useAccountStore()
const accountFormStore = useAccountFormStore()
const commonStore = useCommonStore()

const isEditingDisplayName = ref<boolean>(false)
const displayName = ref<string>(accountStore.state.display_name)
const fileInfo = ref<File>()
const preview = ref<string | undefined>()

const displayNameError = computed((): boolean => 'display_name' in accountFormStore.state.errors)

function handleFileSelected(event: Event): void {
  const target = event.target as HTMLInputElement
  if (target.files && target.files.length > 0) {
    fileInfo.value = target.files[0]
    preview.value = URL.createObjectURL(fileInfo.value)
  }
}

function resetPreview(): void {
  fileInfo.value = undefined
  preview.value = undefined
}

async function doUpdateAvatar(): Promise<void> {
  if (fileInfo.value && accountFormStore.avatarValidate(fileInfo.value)) {
    commonStore.startUploading()
    try {
      await accountFormStore.updateAvatar(fileInfo.value)
    } finally {
      commonStore.stopUploading()
      fileInfo.value = undefined
      preview.value = undefined
    }
  }
}

function toggleEditMode(): void {
  isEditingDisplayName.value = !isEditingDisplayName.value
  // displayNameをrefで管理しているので入力キャンセル時にstateの値に戻す
  displayName.value = accountStore.state.display_name
  accountFormStore.resetErrors()
}

async function doUpdateDisplayName(displayName: string): Promise<void> {
  if (accountFormStore.displayNameValidate(displayName)) {
    commonStore.startApiLoading()
    try {
      await accountFormStore.updateDisplayName(displayName)
    } finally {
      commonStore.stopApiLoading()
      isEditingDisplayName.value = false
    }
  }
}

onUnmounted((): void => {
  accountFormStore.resetErrors()
})
</script>
<template>
  <DashboardContent title="設定">
    <DashboardSection>
      <div class="flex items-center gap-5">
        <AvatarBrowseItem class="w-16" :preview />
        <label
          for="profile_img"
          class="inline-flex h-10 items-center duration-500 gap-2 rounded-full border px-3.5 text-xs cursor-pointer hover:opacity-70"
        >
          プロフィール画像を変更
        </label>
        <input
          type="file"
          class="hidden"
          id="profile_img"
          @change="handleFileSelected"
          accept="image/png, image/jpeg"
        />
      </div>
      <AvatarEditor
        v-show="preview"
        class="mt-3"
        :preview
        @update="doUpdateAvatar"
        @cancel="resetPreview"
      />
      <p v-show="accountFormStore.state.errors.avatar" class="font-body mt-3 text-xs text-red-400">
        {{ accountFormStore.state.errors?.avatar?.[0] }}
      </p>
    </DashboardSection>

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
        @update="doUpdateDisplayName(displayName)"
        @cancel="toggleEditMode"
      />
      <p
        v-show="accountFormStore.state.errors.display_name"
        class="font-body mt-3 text-xs text-red-400"
      >
        {{ accountFormStore.state.errors?.display_name?.[0] }}
      </p>
    </DashboardSection>

    <DashboardSection>
      <DashboardSectionHeader title="カレーのジャンル" />
      <SectionInfo
        text="お好みのカレーのジャンルを登録・変更できます。"
        class="mt-3 text-sm text-utility"
      />
      <GenreSettingButton
        class="inline-flex items-center justify-center border text-sm py-3 px-4 mt-4"
      />
    </DashboardSection>

    <DashboardSection>
      <DashboardSectionHeader title="地方・都道府県" />
      <SectionInfo
        text="表示する投稿の地方や都道府県を登録・変更できます。"
        class="mt-3 text-sm text-utility"
      />
      <RegionSettingButton
        class="inline-flex items-center justify-center border text-sm py-3 px-4 mt-4"
      />
    </DashboardSection>

    <section class="flex justify-center">
      <a class="text-red-400 text-sm" href="#">アカウントの削除</a>
    </section>
  </DashboardContent>
</template>
