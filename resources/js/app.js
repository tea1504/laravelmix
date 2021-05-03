import Vue from 'vue'
import VueRouter from 'vue-router'
import {
  router
} from './router'
import {
  store
} from './store/store'

import $ from "jquery";

import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

import {
  BootstrapVue,
  IconsPlugin
} from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)

Vue.use(IconsPlugin)

import App from './views/App'

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.authOnly)) {
    if (!localStorage.getItem('token')) {
      next({
        path: '/login',
        query: {
          redirect: to.fullPath
        }
      })
    } else {
      if (to.matched.some(record => record.meta.QuanLyOnly)) {
        if(store.getters.isQuanLy){
          next();
        }
        else
        next({
          name: 'error403'
        })
      }
      else
        next();
    };
  } else if (to.matched.some(record => record.meta.guestOnly)) {
    if (localStorage.getItem('token')) {
      next({name: 'Home'})
    } else next();
  }
  else {
    next();
  }
})

Vue.filter('date', function (value) {
  if (!value) return '';
  var d = new Date(value);
  return d.toLocaleDateString('vi');
})

const app = new Vue({
  el: '#app',
  components: {
    App
  },
  store,
  router,
});
