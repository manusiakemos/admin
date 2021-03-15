import Vue from 'vue';
require('./bootstrap');

import axiosInstance from './spa_modules/axios_client';
axiosInstance.defaults.withCredentials = true;
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axiosInstance);

require('./spa_modules/component_loader');

import router from './spa_modules/router';
import store from './spa_modules/store';

import mixins from './mixins.js';
Vue.mixin(mixins);

const spa = new Vue({
    router,
    store
}).$mount('#spa');
