import axios from 'axios';
import { useRouter } from 'vue-router';
import { useCommonStore } from '@/stores/common';

export function useCreatePost() {
  const router = useRouter();
  const commonStore = useCommonStore();

  async function createPost(payload: {
    storeName: string;
    comment?: string;
    genreId?: number;
    postImg?: File;
    latitude: number | undefined;
    longitude: number | undefined;
    formattedAddress: string;
    postcode: string;
    prefecture: string;
    municipality: string;
    ward?: string;
    district: string;
    regionId: number;
    prefectureId: number;
  }) {
    const formData = new FormData();
    formData.append('genre_id', payload.genreId ? payload.genreId.toString() : '');
    formData.append('store_name', payload.storeName);
    formData.append('formatted_address', payload.formattedAddress);
    formData.append('postcode', payload.postcode);
    formData.append('prefecture', payload.prefecture);
    formData.append('municipality', payload.municipality);
    formData.append('district', payload.district);
    formData.append('region_id', payload.regionId.toString());
    formData.append('prefecture_id', payload.prefectureId.toString());

    if (payload.comment) {
      formData.append('comment', payload.comment);
    }
    if (payload.postImg) {
      formData.append('post_img', payload.postImg);
    }
    if (payload.latitude !== undefined) {
      formData.append('latitude', payload.latitude.toString());
    }
    if (payload.longitude !== undefined) {
      formData.append('longitude', payload.longitude.toString());
    }
    if (payload.ward) {
      formData.append('ward', payload.ward);
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
