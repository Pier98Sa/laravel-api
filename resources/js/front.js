window.Vue = require('vue'); //richiamo vue
window.axios = require('axios'); //richiamo axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';
import App from './views/App';

const app = new Vue({
    el: '#root',
    render: h => h(App)
});