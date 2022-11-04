import { createApp } from 'vue'
import App from './pages/App.vue'
const Vue = createApp(App);

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import router from './routes';
Vue.use(router);

import api from './services/apiWrapper';
Vue.config.globalProperties.$api = new api('http://localhost:6969/webapi');

Vue.mount("#app");
