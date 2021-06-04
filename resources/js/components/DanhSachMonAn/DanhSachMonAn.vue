<template>
  <div style="height: 88vh" class="content p-1">
    <b-container fluid class="h-100">
      <b-row class="h-100">
        <b-col md="8" class="h-100">
          <b-card class="h-100 overflow-auto">
            <danh-sach-mon />
          </b-card>
        </b-col>
        <b-col md="4" class="h-100">
          <b-card class="h-100">
            <mon-cho />
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import Dish from '../../apis/Dish';
import MonCho from "../MonCho/MonCho.vue";
import DanhSachMon from "./DanhSachMon.vue";
export default {
  components: { DanhSachMon, MonCho },
  data(){
    return {
      isLoaded: true,
    }
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