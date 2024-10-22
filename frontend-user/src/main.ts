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
import { initializeApp } from 'firebase/app';
import { getAnalytics } from 'firebase/analytics';

const firebaseConfig = {
  apiKey: 'AIzaSyCGBDpw868I0RuRL90NJ7gy1L3NISpalow',
  authDomain: 'curryaddiction-8772e.firebaseapp.com',
  projectId: 'curryaddiction-8772e',
  storageBucket: 'curryaddiction-8772e.appspot.com',
  messagingSenderId: '964769376449',
  appId: '1:964769376449:web:703c92df84d25f10b44c40',
  measurementId: 'G-EQD1QTC5GV'
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
