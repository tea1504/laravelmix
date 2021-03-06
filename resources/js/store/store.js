import Vue from 'vue';
import VueX from 'vuex'

import User from './modules/User'
import Staff from './modules/Staff'
import Department from './modules/Department'
import Table from './modules/Table'
import Type from './modules/Type'
import Dish from './modules/Dish'
import Invoice from './modules/Invoice'

Vue.use(VueX);

export const store = new VueX.Store({
    modules: {
        User,
        Staff,
        Department,
        Table,
        Type,
        Dish,
        Invoice,
    }
});