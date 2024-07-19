import axios from 'axios'
import type { AnalyticsResponse } from '@/composables/types/analytics'

export const useFetchAnalytics = () => {
  async function fetchAnalytics(): Promise<AnalyticsResponse> {
    const response = await axios.get('/api/dashboard/analytics')
    return response.data
  }

  return { fetchAnalytics }
}
