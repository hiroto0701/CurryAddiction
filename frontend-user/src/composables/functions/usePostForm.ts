import { ref, reactive, watch, onMounted, type Ref } from 'vue';
import type { Genre } from '@/types/genre';
import { useValidatePost } from '@/composables/functions/useValidatePost';
import { useCreatePost } from '@/composables/functions/useCreatePost';
import { useCurryGenreStore } from '@/stores/curry_genre';

export function usePostForm() {
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

  function handleFileSelected(target: HTMLInputElement) {
    if (target.files && target.files.length > 0) {
      fileInfo.value = target.files[0];
      preview.value = URL.createObjectURL(fileInfo.value);
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
