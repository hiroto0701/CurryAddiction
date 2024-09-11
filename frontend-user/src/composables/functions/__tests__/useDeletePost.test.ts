import { describe, it, expect, vi } from 'vitest';
import { useDeletePost } from '@/composables/functions/useDeletePost';
import axios from 'axios';

describe('useDeletePost', () => {
  it('投稿をソフトデリートできること', async () => {
    vi.spyOn(axios, 'delete').mockResolvedValueOnce({});

    const { softDeletePost } = useDeletePost();
    const slug = 'test-slug';

    await softDeletePost(slug);

    expect(axios.delete).toHaveBeenCalledWith(`/api/posts/${slug}`);
  });

  it('投稿をハードデリートできること', async () => {
    // Axiosのdeleteメソッドをモック化
    vi.spyOn(axios, 'delete').mockResolvedValueOnce({});

    const { hardDeletePost } = useDeletePost();
    const slug = 'test-slug';

    await hardDeletePost(slug);

    expect(axios.delete).toHaveBeenCalledWith(`/api/dashboard/trash/${slug}`);
  });

  it('削除失敗', async () => {
    vi.spyOn(axios, 'delete').mockRejectedValueOnce(new Error('Network Error'));

    const { softDeletePost } = useDeletePost();
    const slug = 'test-slug';

    await expect(softDeletePost(slug)).rejects.toThrow('Network Error');
  });
});
