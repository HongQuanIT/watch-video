export const state = () => ({
    loading: false,
    menuOpen: false,
});

export const getters = {
    menuOpen: state => state.menuOpen,
    loading: state => state.loading,
};

export const mutations = {
    setMenuOpen(state, data) {
        state.menuOpen = data;
    },
    setLoading(state, data) {
        state.loading = data;
    },
};

export const actions = {
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};