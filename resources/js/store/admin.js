/**
 * Admin Store
 */

import 'es6-promise/auto'
import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        // Mobile Side Menu
        isMobileSideMenuOpen: false,
    },
    mutations: {
        // Mobile Side Menu
        hideMobileSideMenu(state) {
            state.isMobileSideMenuOpen = false;
        },
        showMobileSideMenu(state) {
            state.isMobileSideMenuOpen = true;
        },
        toggleMobileSideMenu(state) {
            state.isMobileSideMenuOpen = !state.isMobileSideMenuOpen;
        },
    },
    getters: {
        isMobileSideMenuOpen: state => state.isMobileSideMenuOpen,
    }
});
