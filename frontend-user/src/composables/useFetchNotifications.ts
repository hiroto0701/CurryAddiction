import axios from 'axios';
import type { NotificationsResponse } from '@/types/notification';

export const useFetchNotifications = () => {
  async function fetchNotificationList(
    params?: Record<string, any>
  ): Promise<NotificationsResponse> {
    const response = await axios.get('/api/notifications', { params });
    return response.data;
  }

  return { fetchNotificationList };
};
