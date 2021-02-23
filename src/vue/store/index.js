import Vue from "vue";
import Vuex from "vuex";
import flights from "./modules/flights"

Vue.use(Vuex);
const store = new Vuex.Store({
    modules: {
        flights
    },
    state: {},
    actions: {},
    mutations: {},
    getters: {}
})

export default store;
