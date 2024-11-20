import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import './style.css';
import 'cal-heatmap/cal-heatmap.css';
import axios from 'axios';
import dayjs from 'dayjs';
import type { Dayjs } from 'dayjs';
import ja from 'dayjs/locale/ja';
import utc from 'dayjs/plugin/utc';
import timezone from 'dayjs/plugin/timezone';
import { useAccountStore } from '@/stores/account';
import { initializeApp } from 'firebase/app';
import { getAnalytics } from 'firebase/analytics';

const firebaseConfig = {
  apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
  authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
  projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
  storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
  messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
  appId: import.meta.env.VITE_FIREBASE_API_ID,
  measurementId: import.meta.env.VITE_FIREBASE_MEASUREMENT_ID
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

axios.defaults.baseURL = import.meta.env.VITE_APP_API_ENDPOINT;
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
axios.interceptors.response.use(
  (response) => response,
  (error) => {
    if ([403, 404].includes(error.response.status)) {
      // 一律404画面を表示する
      router.replace({ name: 'ErrorNotFound' });
    } else if ([401].includes(error.response.status)) {
      // 認証エラー時はWelcomeページへリダイレクト
      const accountStore = useAccountStore();
      accountStore.resetData();
      router.replace({ name: 'Welcome' });
    }
    return Promise.reject(error);
  }
);

dayjs.extend(utc);
dayjs.extend(timezone);
dayjs.locale(ja);
dayjs.tz.setDefault('Asia/Tokyo');

createApp(App)
  .use(createPinia())
  .use(router)
  .provide('$dayjs', dayjs as (date?: string | number | Date | Dayjs) => Dayjs)
  .mount('#app');
