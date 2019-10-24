import Vue from 'vue';
import CountryFlag from 'vue-country-flag'
import VueRouter from "vue-router";
import router from "./App/router";
import App from "./App/App";
let VueScrollTo = require('vue-scrollto');
import VueScrollProgress from 'vue-scroll-progress';
import 'axios';
Vue.use(VueRouter);
Vue.use(VueScrollTo);
Vue.use(VueScrollProgress);

Vue.component('country-flag', CountryFlag);
import { i18n } from './i18n'

new Vue({
    el: '#app',
    router,
    i18n,
    render: h => h(App),
});

