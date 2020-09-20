require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2'


Vue.use(VueSweetalert2);
Vue.use(VueRouter,VueAxios,Axios);
Vue.component('pagination', require('laravel-vue-pagination'));

// import file yang dibuat tadi
import App from './components/App.vue';
import Create from './components/Create.vue';
import Read from './components/Read.vue';
import Update from './components/Update.vue';

// membuat router
const routes = [
    {
        name: 'home',
        path: '/',
        component: Read
    },
    {
        name: 'create',
        path: '/create',
        component: Create
    },
    {
        name: 'editPerson',
        path: '/editPerson',
        component: Update
    }
]

const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");