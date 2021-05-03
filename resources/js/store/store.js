import Vue from 'vue';
import VueX from 'vuex'

import User from './modules/User'
import Staff from './modules/Staff'

Vue.use(VueX);

export const store = new VueX.Store({
    modules: {
        User,
        Staff
    }
});