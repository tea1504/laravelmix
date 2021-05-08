import Vue from 'vue'

Vue.use(VueRouter)

import Home from './views/Home'
import Dashboard from './views/Dashboard'
import Login from './components/Login/Login'
import VueRouter from 'vue-router'
import error404 from './views/404'
import error403 from './views/403'
import Staff from './components/Staff/Staff.vue'
import StaffIndex from './components/Staff/StaffIndex.vue'
import StaffCreate from './components/Staff/StaffCreate.vue'
import StaffEdit from './components/Staff/StaffEdit.vue'
import Department from './components/Department/Department.vue'
import DepartmentIndex from './components/Department/DepartmentIndex.vue'
import Table from './components/Table/Table.vue'
import TableIndex from './components/Table/TableIndex.vue'
import Type from './components/Type/Type.vue'
import TypeIndex from './components/Type/TypeIndex.vue'
import Dish from './components/Dish/Dish.vue'
import DishIndex from './components/Dish/DishIndex.vue'
import DishCreate from './components/Dish/DishCreate.vue'
import DishEdit from './components/Dish/DishEdit.vue'

export const router = new VueRouter({
  mode: 'history',
  linkExactActiveClass: 'active',
  routes: [{
    path: '',
    name: 'Dashboard',
    component: Dashboard,
    meta: {
      authOnly: true
    },
    children: [
      {
        path: '',
        name: 'Home',
        component: Home,
        meta: {
          authOnly: true,
        }
      },
      {
        path: 'staff',
        name: 'Staff',
        component: Staff,
        meta: {
          authOnly: true,
          // QuanLyOnly: true,
        },
        children: [
          {
            path: '',
            name: 'StaffIndex',
            component: StaffIndex,
            meta: {
              authOnly: true,
              // QuanLyOnly: true,
            },
          },
          {
            path: 'create',
            name: 'StaffCreate',
            component: StaffCreate,
            meta: {
              authOnly: true,
              // QuanLyOnly: true,
            },
          },
          {
            path: '/:id/edit',
            name: 'StaffEdit',
            component: StaffEdit,
            meta: {
              authOnly: true,
              // QuanLyOnly: true,
            },
          },
        ]
      },
      {
        path: 'department',
        name: 'Department',
        component: Department,
        meta: {
          authOnly: true,
          //QuanLyOnly: true
        },
        children: [
          {
            path: '',
            name: 'DepartmentIndex',
            component: DepartmentIndex,
          }
        ],
      },
      {
        path: 'table',
        name: 'Table',
        component: Table,
        meta: {
          authOnly: true,
          //QuanLyOnly: true
        },
        children: [
          {
            path: '',
            name: 'TableIndex',
            component: TableIndex,
          }
        ],
      },
      {
        path: 'type',
        name: 'Type',
        component: Type,
        meta: {
          authOnly: true,
          //QuanLyOnly: true
        },
        children: [
          {
            path: '',
            name: 'TypeIndex',
            component: TypeIndex,
          }
        ],
      }, {
        path: 'dish',
        name: 'Dish',
        component: Dish,
        meta: {
          authOnly: true,
          // QuanLyOnly: true,
        },
        children: [
          {
            path: '',
            name: 'DishIndex',
            component: DishIndex,
            meta: {
              authOnly: true,
              // QuanLyOnly: true,
            },
          },
          {
            path: 'create',
            name: 'DishCreate',
            component: DishCreate,
            meta: {
              authOnly: true,
              // QuanLyOnly: true,
            },
          },
          {
            path: '/:id/edit',
            name: 'DishEdit',
            component: DishEdit,
            meta: {
              authOnly: true,
              // QuanLyOnly: true,
            },
          },
        ]
      },
    ]
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      guestOnly: true
    }
  },
  {
    path: '/403',
    name: 'error403',
    component: error403,
    meta: {
      authOnly: true
    }
  },
  {
    path: '/404',
    name: 'error404',
    component: error404,
  },
  {
    path: '*',
    redirect: '/404'
  }
  ]
});
