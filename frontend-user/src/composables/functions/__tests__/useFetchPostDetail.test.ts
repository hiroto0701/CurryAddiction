import axios from 'axios';
import { describe, it, expect, vi } from 'vitest';
import { useFetchPostDetail } from '@/composables/functions/useFetchPostDetail';

vi.mock('axios');

describe('useFetchPostDetail', () => {
  it('投稿詳細取得', async () => {
    const mockData = {
      data: {
        id: 1,
        title: 'Test Post',
        content: 'This is a test post.'
      }
    };
    vi.mocked(axios.get).mockResolvedValueOnce({ data: mockData });

    const { fetchPostDetail } = useFetchPostDetail();
    const post = await fetchPostDetail('test-slug');

    expect(post).toEqual(mockData.data);
  });

  it('投稿詳細取得失敗', async () => {
    vi.mocked(axios.get).mockRejectedValueOnce(new Error('Network Error'));

    const { fetchPostDetail } = useFetchPostDetail();
    await expect(fetchPostDetail('test-slug')).rejects.toThrow('Network Error');
  });
});
