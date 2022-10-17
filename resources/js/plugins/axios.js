import Vue from 'vue'
import store from 'store/index';
import router from 'router/index'
import axios from 'axios'
import Cookie from "js-cookie";

import Url from 'common/constants/app'

axios.defaults.headers.post['Content-Type'] = 'application/json';
// axios.defaults.headers.common['Authorization'] = "AUTH_TOKEN";

axios.defaults.baseURL = Url.API_ADMIN + Url.API_ADMIN_PREFIX;
axios.interceptors.request.use(function (config) {
  // Do something before request is sent
  // console.log(;)
  let token = Cookie.get("token")
  if(token && token.length) {
    config.headers.common["Authorization"] = token;
  }
  

  return config;
}, function (error) {
  return Promise.reject(error);
});

// 
axios.interceptors.response.use(function (response) {
  if(response?.data?.status == "error") {
    store._vm.$toasted.error(response?.data?.messages[0])
    if(response.data.code === 100401) {
      store.dispatch("auth/logout")
      router.push({ name: "login" })
    }
    
  }
  return response;
}, function (error) {
  if (error.response) {
    store._vm.$toasted.error("Error")
    console.log("Error >> " + error.config.url, error.response)
  }
  return Promise.reject(error);
});

Vue.use({
  install (Vue) {
    Vue.prototype.$axios = axios;
    store.$axios = axios;
}
})