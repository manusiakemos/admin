import Vue from 'vue';
import Vuesax from 'vuesax';
Vue.use(Vuesax);


import {BootstrapVue} from 'bootstrap-vue';
Vue.use(BootstrapVue);

import VueHtmlToPaper from 'vue-html-to-paper';
Vue.use(VueHtmlToPaper);

window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('datatables.net-bs4');
require('datatables.net-responsive-bs4');

import VueSidebarMenu from 'vue-sidebar-menu';
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css';
Vue.use(VueSidebarMenu);

import ErrorMessage from "../components/ErrorMessage";
Vue.component("error-message", ErrorMessage);

import SelectAjax from "../components/SelectAjax";
Vue.component("select-ajax", SelectAjax);

import RadioAjax from "../components/RadioAjax";
Vue.component("radio-ajax", RadioAjax);

import CheckboxAjax from "../components/CheckboxAjax";
Vue.component("checkbox-ajax", CheckboxAjax);

import Datepicker from "../components/Datepicker";
Vue.component("datepicker", Datepicker);
