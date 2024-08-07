import { ref, reactive, watch } from 'vue';
import { useValidatePost } from '@/composables/functions/useValidatePost';
import { useCreatePost } from '@/composables/functions/useCreatePost';

export function usePostForm() {
  const { errors, validate } = useValidatePost();
  const { createPost } = useCreatePost();

  const storeName = ref<string>('');
  const comment = ref<string>('');
  const genreId = ref<number | undefined>(1);
  const fileInfo = ref<File>();
  const preview = ref<string | undefined>();
  const latitude = ref<number>(0.1);
  const longitude = ref<number>(0.1);

  const storeNameError = ref<boolean>(false);
  const reactiveErrors = reactive(errors);

  watch(storeName, (newValue) => {
    storeNameError.value = !newValue.length || newValue.length > 30;
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
      store_name: storeName.value,
      comment: comment.value,
      genre_id: genreId.value,
      post_img: fileInfo.value,
      latitude: latitude.value,
      longitude: longitude.value
    });

    return true;
  }

  return {
    storeName,
    comment,
    genreId,
    fileInfo,
    preview,
    latitude,
    longitude,
    storeNameError,
    reactiveErrors,
    handleFileSelected,
    resetPreview,
    submitForm
  };
}
