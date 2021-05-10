<template>
  <div class="content pt-1">
    <router-view :isLoaded="isLoaded" v-on:loading="isLoaded = false" v-on:loaded="isLoaded = true"/>
  </div>
</template>

<script>
import Dish from '../../apis/Dish'
import { mapActions } from 'vuex';
export default {
  data() {
    return {
      isLoaded: true,
    };
  },
  methods: {
    ...mapActions(["setDish"]),
    dishIndex() {
      this.isLoaded = false;
      Dish.index()
        .then((res) => {
          this.setDish(res.data);
          this.isLoaded = true;
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({
              name: "Login",
              query: {
                redirect: to.fullPath,
              },
            });
          } else {
            this.$swal({
              icon: "error",
              title: "Lỗi",
              text: "Không lấy dữ liệu. Hãy thử lại sau.",
            });
          }
          this.isLoaded = true;
        });
    },
  },
  mounted() {
    this.dishIndex();
  },
};
</script>

<style>

</style>