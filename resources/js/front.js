window.Vue = require('vue'); //richiamo vue
window.axios = require('axios'); //richiamo axios

import Vue from 'vue';
import App from './views/App';

const app = new Vue({
    el: '#root',
    render: h => h(App)
});