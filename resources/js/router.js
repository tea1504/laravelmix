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
import Invoice from './components/Invoice/Invoice.vue'
import InvoiceIndex from './components/Invoice/InvoiceIndex.vue'
import InvoiceCreate from './components/Invoice/InvoiceCreate.vue'
import InvoiceEdit from './components/Invoice/InvoiceEdit.vue'
import InvoiceShow from './components/Invoice/InvoiceShow.vue'
import User from './components/User/User.vue'
import UserIndex from './components/User/UserIndex.vue'
import GoiMon from './components/GoiMon/GoiMon.vue'
import ThemMon from './components/ThemMon/ThemMon.vue'
import MonCho from './components/MonCho/MonCho.vue'
import LenMon from './components/LenMon/LenMon.vue'
import DoanhThu from './components/BaoCao/DoanhThu.vue'

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
          authOnly: true
        },
      },
      {
        path: 'goimon',
        name: 'GoiMon',
        component: GoiMon,
        meta: {
          PhucVuOnly: true
        },
      },
      {
        path: 'themmon',
        name: 'ThemMon',
        component: ThemMon,
        meta: {
          PhucVuOnly: true
        },
      },
      {
        path: 'moncho',
        name: 'MonCho',
        component: MonCho,
        meta: {
          BepOnly: true
        },
      },
      {
        path: 'lenmon',
        name: 'LenMon',
        component: LenMon,
        meta: {
          PhucVuOnly: true
        },
      },
      {
        path: 'doanhthu',
        name: 'DoanhThu',
        component: DoanhThu,
        meta: {
          QuanLyOnly: true,
        }
      },
      {
        path: 'staff',
        name: 'Staff',
        component: Staff,
        meta: {
          QuanLyOnly: true,
        },
        children: [
          {
            path: '',
            name: 'StaffIndex',
            component: StaffIndex,
          },
          {
            path: 'create',
            name: 'StaffCreate',
            component: StaffCreate,
          },
          {
            path: ':id/edit',
            name: 'StaffEdit',
            component: StaffEdit,
          },
        ]
      },
      {
        path: 'department',
        name: 'Department',
        component: Department,
        meta: {
          QuanLyOnly: true
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
          QuanLyOnly: true
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
          QuanLyOnly: true,
          BepOnly: true,
        },
        children: [
          {
            path: '',
            name: 'TypeIndex',
            component: TypeIndex,
          }
        ],
      }, 
      {
        path: 'dish',
        name: 'Dish',
        component: Dish,
        meta: {
          QuanLyOnly: true,
          BepOnly: true,
        },
        children: [
          {
            path: '',
            name: 'DishIndex',
            component: DishIndex,
          },
          {
            path: 'create',
            name: 'DishCreate',
            component: DishCreate,
          },
          {
            path: ':id/edit',
            name: 'DishEdit',
            component: DishEdit,
          },
        ]
      },
      {
        path: 'invoice',
        name: 'Invoice',
        component: Invoice,
        meta: {
          QuanLyOnly: true,
          ThuNganOnly: true,
        },
        children: [
          {
            path: '',
            name: 'InvoiceIndex',
            component: InvoiceIndex,
          },
          {
            path: 'create',
            name: 'InvoiceCreate',
            component: InvoiceCreate,
          },
          {
            path: ':id/edit',
            name: 'InvoiceEdit',
            component: InvoiceEdit,
          },
          {
            path: ':id',
            name: 'InvoiceShow',
            component: InvoiceShow,
          },
        ]
      },
      {
        path: 'user',
        name: 'User',
        component: User,
        children: [
          {
            path: '',
            name: 'UserIndex',
            component: UserIndex,
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
