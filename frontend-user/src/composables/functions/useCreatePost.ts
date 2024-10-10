import axios from 'axios';
import { useRouter } from 'vue-router';
import { useCommonStore } from '@/stores/common';

export function useCreatePost() {
  const router = useRouter();
  const commonStore = useCommonStore();

  async function createPost(payload: {
    store_name: string;
    comment?: string;
    genre_id?: number;
    post_img?: File;
    latitude: number | undefined;
    longitude: number | undefined;
  }) {
    const formData = new FormData();
    formData.append('genre_id', payload.genre_id ? payload.genre_id.toString() : '');
    formData.append('region_id', '1');
    formData.append('prefecture_id', '2');
    formData.append('store_name', payload.store_name);
    if (payload.comment) {
      formData.append('comment', payload.comment);
    }
    if (payload.post_img) {
      formData.append('post_img', payload.post_img);
    }
    if (payload.latitude !== undefined) {
      formData.append('latitude', payload.latitude.toString());
    }
    if (payload.longitude !== undefined) {
      formData.append('longitude', payload.longitude.toString());
    }

    const config = {
      headers: {
        'content-type': 'multipart/form-data',
        'X-HTTP-Method-Override': 'POST'
      }
    };

    try {
      commonStore.startApiLoading();
      await axios.post('/api/posts/', formData, config);

      await router.push({ name: 'Home' });
      commonStore.setFlashMessage('投稿しました');
      setTimeout(() => {
        commonStore.clearFlashMessage();
      }, 4000);
    } catch (error: unknown) {
      commonStore.setErrorMessage('投稿に失敗しました');
      window.scrollTo({
        top: 0
      });
      setTimeout(() => {
        commonStore.clearErrorMessage();
      }, 4000);
    } finally {
      commonStore.stopApiLoading();
    }
  }

  return {
    createPost
  };
}
