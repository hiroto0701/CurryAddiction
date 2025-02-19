<script setup lang="ts">
import axios from 'axios';
import imageCompression from 'browser-image-compression';
import { ref, computed, onUnmounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAccountStore } from '@/stores/account';
import { useAccountFormStore } from '@/stores/account_form';
import { useCommonStore } from '@/stores/common';
import { useFavoriteGenre } from '@/composables/useFavoriteGenre';
import { useFavoritePrefecture } from '@/composables/useFavoritePrefecture';
import SectionInfo from '@/views/atoms/dashboard/SectionInfo.vue';
import DashboardContent from '@/views/molecules/dashboard/DashboardContent.vue';
import DashboardSectionHeader from '@/views/atoms/dashboard/DashboardSectionHeader.vue';
import DashboardSection from '@/views/molecules/dashboard/DashboardSection.vue';
import AvatarBrowseItem from '@/views/molecules/browseItems/AvatarBrowseItem.vue';
import DisplayNameViewer from '@/views/pages/Dashboard/Setting/components/DisplayNameViewer.vue';
import DisplayNameEditor from '@/views/pages/Dashboard/Setting/components/DisplayNameEditor.vue';
import FavoriteGenreViewer from '@/views/pages/Dashboard/Setting/components/FavoriteGenreViewer.vue';
import FavoriteGenreEditor from '@/views/pages/Dashboard/Setting/components/FavoriteGenreEditor.vue';
import FavoriteRegionViewer from '@/views/pages/Dashboard/Setting/components/FavoriteRegionViewer.vue';
import FavoriteRegionEditor from '@/views/pages/Dashboard/Setting/components/FavoriteRegionEditor.vue';
import AvatarEditor from '@/views/pages/Dashboard/Setting/components/AvatarEditor.vue';
import DeleteConfirmModal from '@/views/molecules/modals/DeleteConfirmModal.vue';

const router = useRouter();
const accountStore = useAccountStore();
const accountFormStore = useAccountFormStore();
const commonStore = useCommonStore();
const { favoriteGenre } = useFavoriteGenre();
const { favoritePrefecture } = useFavoritePrefecture();

const isEditingDisplayName = ref<boolean>(false);
const isEditingFavoriteGenre = ref<boolean>(false);
const isEditingFavoritePrefecture = ref<boolean>(false);
const displayName = ref<string>(accountStore.state.display_name);
const favoriteGenres = ref<number[]>(accountStore.state.favorite_genres.map((fg) => fg.genre_id));
const favoritePrefectures = ref<number[]>(
  accountStore.state.favorite_prefectures.map((fp) => fp.prefecture_id)
);
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

function openModal(): void {
  open.value = true;
  document.body.style.overflow = 'hidden';
}

function closeModal(): void {
  open.value = false;
  document.body.style.overflow = 'auto';
}

async function handleFileSelected(event: Event) {
  const compressionOptions = {
    maxSizeMB: 1, // 最大1MB
    maxWidthOrHeight: 1920, // 縦横最大1920px
    useWebWorker: true,
    initialQuality: 0.7 // 70%くらいの品質にする
  };

  const target = event.target as HTMLInputElement;

  if (!target.files || target.files.length === 0) return;

  try {
    const originalFile = target.files[0];

    if (!originalFile.type.startsWith('image/')) {
      fileInfo.value = originalFile;
      preview.value = URL.createObjectURL(originalFile);
      return;
    }

    // 画像を圧縮
    const compressedFile = await imageCompression(originalFile, compressionOptions);

    fileInfo.value = compressedFile;
    preview.value = URL.createObjectURL(compressedFile);
  } catch (error) {
    console.error('画像の圧縮中にエラーが発生しました:', error);
    commonStore.setErrorMessage('画像の処理に失敗しました');
    setTimeout(() => {
      commonStore.clearErrorMessage();
    }, 4000);
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

function toggleEditName(): void {
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

function toggleEditGenre(): void {
  isEditingFavoriteGenre.value = !isEditingFavoriteGenre.value;
  // favoriteGenresをrefで管理しているので入力キャンセル時にstateの値に戻す
  favoriteGenres.value = accountStore.state.favorite_genres.map((fg) => fg.genre_id);
  accountFormStore.resetErrors();
}

async function doUpdateFavoriteGenre(selectedGenres: number[]): Promise<void> {
  try {
    commonStore.startApiLoading();
    const sortedSelectGenres = selectedGenres.sort();
    const response = await favoriteGenre(sortedSelectGenres);

    if (response?.status === 200) {
      // stateのfavorite_genresを更新
      accountStore.updateFavoriteGenres(sortedSelectGenres);

      commonStore.setFlashMessage('更新しました');
      setTimeout(() => {
        commonStore.clearFlashMessage();
      }, 4000);
    } else {
      throw new Error(response?.data.message);
    }
  } catch (error) {
    console.error('お気に入りのジャンルの更新に失敗しました:', error);
    if (axios.isAxiosError(error)) {
      console.error(
        `お気に入りのジャンルの更新に失敗しました: ${error.response?.data?.message || error.message}`,
        error
      );
    } else {
      console.error('予期せぬエラーが発生しました', error);
    }
  } finally {
    isEditingFavoriteGenre.value = false;
    commonStore.stopApiLoading();
  }
}

function toggleEditPrefecture(): void {
  isEditingFavoritePrefecture.value = !isEditingFavoritePrefecture.value;
  // favoritePrefecturesをrefで管理しているので入力キャンセル時にstateの値に戻す
  favoritePrefectures.value = accountStore.state.favorite_prefectures.map((fp) => fp.prefecture_id);
  accountFormStore.resetErrors();
}

async function doUpdateFavoritePrefecture(selectedPrefectures: number[]): Promise<void> {
  try {
    commonStore.startApiLoading();
    const sortedSelectPrefectures = selectedPrefectures.sort();
    const response = await favoritePrefecture(sortedSelectPrefectures);

    if (response?.status === 200) {
      // stateのfavorite_prefecturesを更新
      accountStore.updateFavoritePrefectures(sortedSelectPrefectures);

      commonStore.setFlashMessage('更新しました');
      setTimeout(() => {
        commonStore.clearFlashMessage();
      }, 4000);
    } else {
      throw new Error(response?.data.message);
    }
  } catch (error) {
    console.error('お気に入りのジャンルの更新に失敗しました:', error);
    if (axios.isAxiosError(error)) {
      console.error(
        `お気に入りのジャンルの更新に失敗しました: ${error.response?.data?.message || error.message}`,
        error
      );
    } else {
      console.error('予期せぬエラーが発生しました', error);
    }
  } finally {
    isEditingFavoritePrefecture.value = false;
    commonStore.stopApiLoading();
  }
}

async function doDelete(): Promise<void> {
  try {
    commonStore.startApiLoading();
    const response = await accountFormStore.deleteAccount(String(accountStore.state.uuid));
    if (response.status === 200) {
      closeModal();
      accountStore.resetData();
      window.alert('アカウントを削除しました。');
      router.push({ name: 'Welcome' });
      document.body.style.overflow = 'auto';
    } else {
      throw new Error(response.data.message);
    }
  } catch (error) {
    console.error('削除に失敗しました:', error);
    if (axios.isAxiosError(error)) {
      console.error(`削除に失敗しました: ${error.response?.data?.message || error.message}`, error);
    } else {
      console.error('予期せぬエラーが発生しました', error);
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
        @edit="toggleEditName"
      />
      <DisplayNameEditor
        v-else
        :is-error="displayNameError"
        v-model="displayName"
        @update="doUpdateDisplayName(displayName)"
        @cancel="toggleEditName"
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
        text="表示する投稿のカレーのジャンルを登録・変更できます。"
        class="my-5 text-sm text-utility"
      />
      <FavoriteGenreViewer v-if="!isEditingFavoriteGenre" @edit="toggleEditGenre" />
      <FavoriteGenreEditor
        v-else
        @update="doUpdateFavoriteGenre(favoriteGenres)"
        @cancel="toggleEditGenre"
        v-model="favoriteGenres"
      />
    </DashboardSection>

    <DashboardSection>
      <DashboardSectionHeader title="地方・都道府県" />
      <SectionInfo
        text="表示する投稿の地方や都道府県を登録・変更できます。"
        class="my-5 text-sm text-utility"
      />
      <FavoriteRegionViewer v-if="!isEditingFavoritePrefecture" @edit="toggleEditPrefecture" />
      <FavoriteRegionEditor
        v-else
        @update="doUpdateFavoritePrefecture(favoritePrefectures)"
        @cancel="toggleEditPrefecture"
        v-model="favoritePrefectures"
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
