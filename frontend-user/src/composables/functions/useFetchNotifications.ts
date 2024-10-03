import axios from 'axios';

export const useFetchNotifications = () => {
  async function fetchNotificationList(params?: Record<string, any>) {
    const response = await axios.get('/api/notifications', { params });
    return response.data;
  }

  return { fetchNotificationList };
};
