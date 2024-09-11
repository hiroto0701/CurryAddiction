import { describe, it, expect, vi } from 'vitest';
import { useArchivePost } from '@/composables/functions/useArchivePost';
import axios from 'axios';

describe('useArchivePost.ts', () => {
  it('投稿を保存（アーカイブ）できること', async () => {
    vi.spyOn(axios, 'post').mockResolvedValueOnce({
      data: { message: '保存成功' },
      status: 200
    });

    const { archivePost } = useArchivePost();
    const response = await archivePost(123);

    expect(response.data.message).toBe('保存成功');
    expect(axios.post).toHaveBeenCalledWith('/api/posts/123/archives');
  });

  it('保存失敗', async () => {
    vi.spyOn(axios, 'post').mockRejectedValueOnce(new Error('Network Error'));

    const { archivePost } = useArchivePost();

    await expect(archivePost(123)).rejects.toThrow('Network Error');
  });
});
