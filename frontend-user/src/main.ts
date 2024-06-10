import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import './style.css'
import axios from 'axios'
import dayjs from 'dayjs'
import ja from 'dayjs/locale/ja'

axios.defaults.baseURL = import.meta.env.VITE_APP_API_ENDPOINT
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

dayjs.locale(ja)

createApp(App).use(createPinia()).use(router).provide('$dayjs', dayjs).mount('#app')
