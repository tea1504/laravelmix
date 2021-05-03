<template>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"
          ><i class="fab fa-accessible-icon"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a @click.prevent="logout" style="cursor: pointer;" class="nav-link">Đăng xuất</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
    </ul>
  </nav>
</template>

<script>
import User from '../apis/User';
export default {
  methods:{
    logout(){
      User.logout().then(()=>{
        localStorage.removeItem('token');
        this.$router.push({name: 'Login'});
      }).catch(err=>{
        if(err.response.status == 401)
          localStorage.removeItem('token');
      });
    }
  }
};
</script>

<style>
</style>