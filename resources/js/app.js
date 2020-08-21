window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');
Vue.component('users-balance', require('../vue/pages/UserBalance').default);

import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)



import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'

Vue.component('datetime', Datetime);

const app = new Vue({
    el: '#app'
});
