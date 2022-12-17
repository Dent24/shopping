import { createStore } from 'vuex'

export default createStore({
    state: {
        isLogin: false,
        loading: false
    },
    getters: {
        getIsLogin: state => state.isLogin,
        getLoading: state => state.loading
    },
    mutations: {
        setIsLogin(state, bol) { state.isLogin = bol },
        setLoading(state, bol) { state.loading = bol }
    },
    actions: {
        setIsLogin({ commit }, bol) { commit('setIsLogin', bol) },
        setLoading({ commit }, bol) { commit('setLoading', bol) }
    }
})