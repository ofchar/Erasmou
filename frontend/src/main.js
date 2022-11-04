import { createApp } from 'vue'
import App from './pages/App.vue'
const Vue = createApp(App);

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import router from './routes';
Vue.use(router);

Vue.mount("#app");
