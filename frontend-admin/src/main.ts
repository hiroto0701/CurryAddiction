import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import './style.css'
import axios from 'axios'

// api側にリクエスト送る際のURLを設定
axios.defaults.baseURL = import.meta.env.VITE_APP_API_ENDPOINT;

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
