require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router';

import router from 'router/index'
import store from 'store/index';
import App from 'App.vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

//layout
import Layout from 'layouts/Layout'
Vue.component('Layout', Layout)

//plugin
import 'plugins/axios';
import 'plugins/vue-toast'
import 'plugins/vue-awesome'
import i18n from 'plugins/vue-i18n';

Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


const app = new Vue({
  el: '#app',
  i18n,
  router,
  store,
  components: { App }
});
