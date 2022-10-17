import Vue from "vue";
import Vuex from "vuex";

import home from "store/home";
import auth from "store/auth";
import common from "store/common";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    home,
    auth,
    common
  }
});