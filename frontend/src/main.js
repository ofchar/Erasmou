import { createApp } from 'vue'
import App from './pages/App.vue'


import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { faFaceSmile, faFaceMeh, faFaceFrown, faFaceMehBlank } from '@fortawesome/free-regular-svg-icons'
import { faCheckDouble, faSitemap, faStar } from '@fortawesome/free-solid-svg-icons'
library.add( faFaceSmile, faFaceMeh, faFaceFrown, faFaceMehBlank, faCheckDouble, faSitemap, faStar );

import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';


const Vue = createApp(App)
    .component('font-awesome-icon', FontAwesomeIcon)
    .component('v-select', vSelect);

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import router from './routes';
Vue.use(router);

import api from './services/apiWrapper';
Vue.config.globalProperties.$api = new api('http://localhost:6969');

import Swal from 'sweetalert2'
Vue.config.globalProperties.$swal = Swal;

Vue.mount("#app");
