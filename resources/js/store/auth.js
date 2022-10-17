import Cookie from "js-cookie";

export const state = () => ({
  token: "",
  user: null,
});

// getters
export const getters = {
  token: state => state.token,
  user: state => state.user,
};

// mutations
export const mutations = {
  setToken(state, payload) {
    state.token = payload;
    Cookie.set("token", payload, { expires: 7 });
  },
  setUser(state, payload) {
    state.user = payload;
  },
};

// actions
export const actions = {
  async signIn({ commit, dispatch }, user) {
    let response = await this.$axios.post("/login", user);
    if(response?.data?.status == "success") {
      commit("setToken", response.data.data.token);
      commit("setUser", response.data.data.user);
      return Promise.resolve(response.data);
    }
  },

  async fetchUser({ commit }) {
    let response = await this.$axios.get("/user/profile");
    if(response?.data?.status == "success") {
      commit("setUser", response.data.data.user);
      return Promise.resolve(response.data);
    }
  },

  async logout({ commit, dispatch }, user) {
    await this.$axios.get("/logout");
    commit("setUser", null);
    commit("setToken", "");

  },

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  };
