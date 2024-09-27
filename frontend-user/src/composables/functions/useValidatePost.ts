import { ref } from 'vue';

interface PostErrors {
  storeName?: string[];
  comment?: string[];
  genreId?: string[];
  postImg?: string[];
  location?: string[];
}

export function useValidatePost() {
  const errors = ref<PostErrors>({});

  function validate(
    storeName: string,
    comment: string,
    genreId: number | undefined,
    postImg: File | undefined,
    latitude: number | null,
    longitude: number | null
  ): boolean {
    errors.value = {};

    // 店名のバリデーション
    if (!storeName) {
      errors.value.storeName = ['店名は必須項目です'];
    } else if (storeName.length > 30) {
      errors.value.storeName = ['店名は30文字以内で入力してください'];
    }

    // 感想のバリデーション
    if (comment && comment.length > 140) {
      errors.value.comment = ['感想 は140文字以内で入力してください'];
    }

    // ジャンルIDのバリデーション
    if (!genreId) {
      errors.value.genreId = ['カレーのジャンルは必須項目です'];
    }

    // 投稿画像のバリデーション
    if (postImg) {
      const allowedExtensions: string[] = ['png', 'jpeg', 'jpg'];
      const extension: string | undefined = postImg.name.split('.').pop()?.toLowerCase();

      if (postImg.size > 10 * 1024 * 1024) {
        errors.value.postImg = ['カレーの画像のサイズは10MB以内にしてください'];
      } else if (!extension || !allowedExtensions.includes(extension)) {
        errors.value.postImg = ['ファイルは.png .jpeg .jpg形式を指定してください。'];
      }
    } else {
      errors.value.postImg = ['カレーの画像は必須項目です'];
    }

    // 緯度経度のバリデーション
    if (!latitude || !longitude) {
      errors.value.location = ['位置情報は必須項目です'];
    }

    return Object.keys(errors.value).length === 0;
  }

  return {
    errors,
    validate
  };
}
