import { describe, it, expect, vi } from 'vitest';
import { useFetchAnalytics } from '@/composables/functions/useFetchAnalytics';
import axios from 'axios';
import type { AnalyticsResponse } from '@/composables/types/analytics';

// モックデータの作成
const mockAnalyticsData: AnalyticsResponse = {
  data: [
    { date: '2024-07-01', count: 100 },
    { date: '2024-09-08', count: 120 },
    { date: '2024-11-14', count: 95 }
  ]
};

describe('useFetchAnalytics', () => {
  it('ユーザー情報取得', async () => {
    vi.spyOn(axios, 'get').mockResolvedValueOnce({ data: mockAnalyticsData });

    const { fetchAnalytics } = useFetchAnalytics();

    const response = await fetchAnalytics();

    expect(axios.get).toHaveBeenCalledWith('/api/dashboard/analytics');
    expect(response).toEqual(mockAnalyticsData);
  });

  it('ユーザー情報取得失敗', async () => {
    vi.spyOn(axios, 'get').mockRejectedValueOnce(new Error('Network Error'));

    const { fetchAnalytics } = useFetchAnalytics();

    await expect(fetchAnalytics()).rejects.toThrow('Network Error');
  });
});
