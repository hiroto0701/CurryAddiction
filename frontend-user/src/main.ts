import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import './style.css'
import axios from 'axios'

axios.defaults.baseURL = import.meta.env.VITE_APP_API_ENDPOINT;
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
