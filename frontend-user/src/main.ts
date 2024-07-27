import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import './style.css'
import 'cal-heatmap/cal-heatmap.css'
import axios from 'axios'
import dayjs from 'dayjs'
import type { Dayjs } from 'dayjs'
import ja from 'dayjs/locale/ja'
import utc from 'dayjs/plugin/utc'
import timezone from 'dayjs/plugin/timezone'

axios.defaults.baseURL = import.meta.env.VITE_APP_API_ENDPOINT
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

dayjs.extend(utc)
dayjs.extend(timezone)
dayjs.locale(ja)
dayjs.tz.setDefault('Asia/Tokyo')

createApp(App)
  .use(createPinia())
  .use(router)
  .provide('$dayjs', dayjs as (date?: string | number | Date | Dayjs) => Dayjs)
  .mount('#app')
