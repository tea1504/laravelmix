<template>
  <div class="p-1">
    <b-button :to="{name: 'Home'}">Trở về</b-button>
    <b-row cols="1">
      <b-col v-for="monCho in ListMonCho" :key="monCho.id">
        <b-card
          :img-src="monCho.image"
          img-height="200"
          img-alt="Card image"
          img-left
          class="mb-3"
        >
          <b-card-text>
            <h3>{{ monCho.name }}</h3>
            <p><b>Số lượng:</b> {{ monCho.amount }}</p>
            <p><b>Bàn:</b> {{ monCho.table_name }}</p>
            <b-button @click="daCheBien(monCho.id)">Đã chế biến xong</b-button>
          </b-card-text>
        </b-card>
      </b-col>
    </b-row>
    <spinner v-if="!isLoaded" />
  </div>
</template>

<script>
import Other from "../../apis/Other";
import Spinner from "../../views/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      isLoaded: true,
      ListMonCho: [],
    };
  },
  methods: {
    getMonCho() {
      this.isLoaded = false;
      Other.getMonCho()
        .then((res) => {
          this.ListMonCho = res.data;
          this.isLoaded = true;
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({
              name: "Login",
              query: { redirect: to.fullPath },
            });
          } else {
            this.$swal({
              icon: "error",
              title: "Lỗi",
              text: "Không thể lấy dữ liệu. Hãy thử lại sau.",
            });
          }
          this.loaded = true;
        });
    },
    daCheBien(id) {
      this.$swal({
        title: "Món an đã chế biến xong?",
        showCancelButton: true,
        confirmButtonText: `Đã xong`,
      }).then((result) => {
        if (result.isConfirmed) {
          this.isLoaded = false;
          Other.daCheBien(id)
            .then((res) => {
              this.$swal("Thao tác thành công").then(() => {
                this.getMonCho();
              });
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
              }
              this.isLoaded = true;
            });
        } else {
          this.$swal("Đã hủy thao tác");
        }
      });
    },
  },
  mounted() {
    this.getMonCho();
  },
};
</script>

<style>
</style>