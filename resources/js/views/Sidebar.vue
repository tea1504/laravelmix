<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a
      @click="$router.push({ name: 'Home' })"
      class="brand-link"
      style="cursor: pointer"
    >
      <img
        src="http://demo.laravelmix.local:81/api/image/chung/icon.png"
        alt="logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">FoodVUE</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img :src="getUser.image" class="img-circle elevation-2" alt="User" />
        </div>
        <div class="info">
          <a href="#" class="d-block"
            >{{ getUser.lastName }} {{ getUser.firstName }}</a
          >
        </div>
      </div>
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item" v-if="isQuanLy">
            <router-link tag="a" class="nav-link" :to="{ name: 'StaffIndex' }"
              ><i class="nav-icon fas fa-address-book"></i>
              <p>Nhân viên</p></router-link
            >
          </li>
        </ul>
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item" v-if="isQuanLy">
            <router-link
              tag="a"
              class="nav-link"
              :to="{ name: 'DepartmentIndex' }"
              ><i class="nav-icon fas fa-address-book"></i>
              <p>Bộ phận</p></router-link
            >
          </li>
        </ul>
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item" v-if="isQuanLy">
            <router-link tag="a" class="nav-link" :to="{ name: 'TableIndex' }"
              ><i class="nav-icon fas fa-address-book"></i>
              <p>Bàn</p></router-link
            >
          </li>
        </ul>
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item" v-if="isQuanLy">
            <router-link tag="a" class="nav-link" :to="{ name: 'TypeIndex' }"
              ><i class="nav-icon fas fa-address-book"></i>
              <p>Loại món ăn</p></router-link
            >
          </li>
        </ul>
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item" v-if="isQuanLy">
            <router-link tag="a" class="nav-link" :to="{ name: 'DishIndex' }"
              ><i class="nav-icon fas fa-address-book"></i>
              <p>Món ăn</p></router-link
            >
          </li>
        </ul>
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item" v-if="isQuanLy">
            <router-link tag="a" class="nav-link" :to="{ name: 'InvoiceIndex' }"
              ><i class="nav-icon fas fa-address-book"></i>
              <p>Hóa đơn</p></router-link
            >
          </li>
        </ul>
      </nav>
    </div>
  </aside>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["getUser", "isQuanLy"]),
  },
};
</script>

<style>
</style>