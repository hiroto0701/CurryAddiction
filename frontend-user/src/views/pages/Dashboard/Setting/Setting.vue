<script setup lang="ts">
import axios from 'axios';
import { ref, computed, onUnmounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAccountStore } from '@/stores/account';
import { useAccountFormStore } from '@/stores/account_form';
import { useCommonStore } from '@/stores/common';
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue';
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue';
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue';
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue';
import GenreSettingButton from '@/views/molecules/buttons/GenreSettingButton.vue';
import RegionSettingButton from '@/views/molecules/buttons/RegionSettingButton.vue';
import AvatarBrowseItem from '@/views/molecules/browseItems/AvatarBrowseItem.vue';
import DisplayNameViewer from '@/views/pages/Dashboard/Setting/components/DisplayNameViewer.vue';
import DisplayNameEditor from '@/views/pages/Dashboard/Setting/components/DisplayNameEditor.vue';
import AvatarEditor from '@/views/pages/Dashboard/Setting/components/AvatarEditor.vue';
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue';

const router = useRouter();
const accountStore = useAccountStore();
const accountFormStore = useAccountFormStore();
const commonStore = useCommonStore();

const isEditingDisplayName = ref<boolean>(false);
const displayName = ref<string>(accountStore.state.display_name);
const fileInfo = ref<File>();
const preview = ref<string | undefined>();
const open = ref<boolean>(false);

const modalContent = ref<string>(`一度削除したアカウントは復元できません。\n本当に削除しますか？`);

const displayNameError = computed(
  (): boolean =>
    'display_name' in accountFormStore.state.errors ||
    !displayName.value.length ||
    displayName.value.length > 20
);

function handleFileSelected(event: Event): void {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    fileInfo.value = target.files[0];
    preview.value = URL.createObjectURL(fileInfo.value);
  }
}

function resetPreview(): void {
  fileInfo.value = undefined;
  preview.value = undefined;
}

async function doUpdateAvatar(): Promise<void> {
  if (fileInfo.value && accountFormStore.avatarValidate(fileInfo.value)) {
    try {
      await accountFormStore.updateAvatar(fileInfo.value);
    } finally {
      fileInfo.value = undefined;
      preview.value = undefined;
    }
  }
}

function toggleEditMode(): void {
  isEditingDisplayName.value = !isEditingDisplayName.value;
  // displayNameをrefで管理しているので入力キャンセル時にstateの値に戻す
  displayName.value = accountStore.state.display_name;
  accountFormStore.resetErrors();
}

async function doUpdateDisplayName(displayName: string): Promise<void> {
  if (accountFormStore.displayNameValidate(displayName)) {
    try {
      await accountFormStore.updateDisplayName(displayName);
    } finally {
      isEditingDisplayName.value = false;
    }
  }
}

function openModal(): void {
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  open.value = false;
  document.body.style.overflow = 'auto';
}

async function doDelete(): Promise<void> {
  try {
    commonStore.startApiLoading();
    const response = await accountFormStore.deleteAccount(String(accountStore.state.uuid));
    if (response.status === 200) {
      closeModal();
      router.push({ name: 'Top' });
      document.body.style.overflow = 'auto';
    } else {
      throw new Error(response.data.message);
    }
  } catch (error) {
    console.error('削除に失敗しました:', error);
    if (axios.isAxiosError(error)) {
      console.error(`削除に失敗しました: ${error.response?.data?.message || error.message}`, error);
    } else {
      console.log('予期せぬエラーが発生しました', error);
    }
  } finally {
    commonStore.stopApiLoading();
  }
}

onUnmounted((): void => {
  accountFormStore.resetErrors();
});
</script>
<template>
  <DashboardContent title="設定">
    <DashboardSection>
      <div class="flex items-center gap-5">
        <AvatarBrowseItem class="w-16" :preview :avatar-url="accountStore.state.avatar_url" />
        <label
          for="profile_img"
          class="inline-flex h-10 cursor-pointer items-center gap-2 rounded-full border px-3.5 text-xs duration-500 hover:opacity-70"
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
      <p v-show="accountFormStore.state.errors.avatar" class="mt-3 font-body text-xs text-red-400">
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
        class="mt-3 font-body text-xs text-red-400"
      >
        {{ accountFormStore.state.errors?.display_name?.[0] }}
      </p>
    </DashboardSection>

    <DashboardSection>
      <DashboardSectionHeader title="カレーのジャンル" />
      <SectionInfo
        text="表示するカレーのジャンルを登録・変更できます。"
        class="mt-3 text-sm text-utility"
      />
      <GenreSettingButton
        class="mt-4 inline-flex items-center justify-center border px-4 py-3 text-sm"
      />
    </DashboardSection>

    <DashboardSection>
      <DashboardSectionHeader title="地方・都道府県" />
      <SectionInfo
        text="表示する投稿の地方や都道府県を登録・変更できます。"
        class="mt-3 text-sm text-utility"
      />
      <RegionSettingButton
        class="mt-4 inline-flex items-center justify-center border px-4 py-3 text-sm"
      />
    </DashboardSection>

    <section class="flex justify-center">
      <button class="text-sm text-red-400" @click="openModal">アカウントの削除</button>
    </section>

    <Teleport to="body">
      <DeleteConfirmModal
        v-show="open"
        :is-loading="commonStore.state.apiLoading"
        modal-title="アカウントを削除しますか？"
        :modal-content
        button-text="削除する"
        @delete="doDelete"
        @cancel="closeModal"
        :closeModal="closeModal"
      />
    </Teleport>
  </DashboardContent>
</template>
