import { ref, reactive, watch, onMounted, type Ref } from 'vue';
import imageCompression from 'browser-image-compression';
import type { Genre } from '@/types/genre';
import { useValidatePost } from '@/composables/useValidatePost';
import { useCommonStore } from '@/stores/common';
import { useCreatePost } from '@/composables/useCreatePost';
import { useCurryGenreStore } from '@/stores/curry_genre';

export function usePostForm() {
  const commonStore = useCommonStore();
  const { errors, validate } = useValidatePost();
  const { createPost } = useCreatePost();
  const curryGenreStore = useCurryGenreStore();

  const storeName = ref<string>('');
  const comment = ref<string>('');
  const genreId = ref<number | undefined>();
  const genreOptions: Ref<Genre[]> = ref([
    { id: undefined, name: '選択してください', disabled: true }
  ]);
  const fileInfo = ref<File>();
  const preview = ref<string | undefined>();
  const latitude = ref<number | undefined>();
  const longitude = ref<number | undefined>();
  const officialName = ref<string>('');
  const formattedAddress = ref<string>('');
  const postcode = ref<string>('');
  const prefecture = ref<string>('');
  const municipality = ref<string>('');
  const ward = ref<string | undefined>();
  const district = ref<string>('');
  const regionId = ref<number | null>(null);
  const prefectureId = ref<number | null>(null);
  const storeNameError = ref<boolean>(false);
  const reactiveErrors = reactive(errors);

  watch(storeName, (newValue) => {
    storeNameError.value = !newValue.length || newValue.length > 30;
  });

  // 「選択してください」は選択不可（非活性）にする
  onMounted(async (): Promise<void> => {
    await curryGenreStore.fetchGenres();
    genreOptions.value = [
      { id: undefined, name: '選択してください', disabled: true },
      ...curryGenreStore.state.genres.map((genre) => ({ ...genre, disabled: false }))
    ];
  });

  async function handleFileSelected(target: HTMLInputElement) {
    const compressionOptions = {
      maxSizeMB: 1, // 最大1MB
      maxWidthOrHeight: 1920, // 縦横最大1920px
      useWebWorker: true,
      initialQuality: 0.7 // 70%くらいの品質にする
    };

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

  function resetPreview() {
    fileInfo.value = undefined;
    preview.value = undefined;
  }

  async function submitForm(): Promise<boolean> {
    const isValid = validate(
      storeName.value,
      comment.value,
      genreId.value,
      fileInfo.value,
      latitude.value,
      longitude.value
    );

    if (!isValid) {
      throw new Error('バリデーションエラー');
    }

    await createPost({
      storeName: storeName.value,
      comment: comment.value,
      genreId: genreId.value,
      postImg: fileInfo.value,
      latitude: latitude.value,
      longitude: longitude.value,
      officialName: officialName.value,
      formattedAddress: formattedAddress.value,
      postcode: postcode.value,
      prefecture: prefecture.value,
      municipality: municipality.value,
      ward: ward.value,
      district: district.value,
      regionId: regionId.value as number,
      prefectureId: prefectureId.value as number
    });

    return true;
  }

  return {
    storeName,
    comment,
    genreId,
    genreOptions,
    fileInfo,
    preview,
    latitude,
    longitude,
    officialName,
    formattedAddress,
    postcode,
    prefecture,
    municipality,
    ward,
    district,
    regionId,
    prefectureId,
    storeNameError,
    reactiveErrors,
    handleFileSelected,
    resetPreview,
    submitForm
  };
}
