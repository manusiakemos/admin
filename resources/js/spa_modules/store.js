import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersistence from 'vuex-persist';

const vuexLocal = new VuexPersistence({
    storage: window.localStorage,
    key: 'crud-spa-2020',
});

Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        appName: 'LARAVEL CRUD',
        auth: false,
        activeSidebar: true,
        user: {}
    },
    mutations: {
        SET_AUTH(state, value) {
            state.auth = value;
        },
        SET_USER(state, value) {
            state.user = value;
        },
        SET_SIDEBAR(state) {
            state.activeSidebar = !state.activeSidebar;
        }
    },
    plugins: [vuexLocal.plugin]
});

export default store;
