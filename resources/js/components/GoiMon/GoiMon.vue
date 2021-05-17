<template>
  <div class="p-1">
    <b-card>
        <b-row cols-md="6" cols="4">
          <b-col v-for="table in tables" :key="table.id">
            <router-link
              tag="div"
              :to="{ name: 'InvoiceCreate', query: { table: table.id } }"
              class="text-center myicon"
            >
              <span>{{ table.name }}</span>
            </router-link>
          </b-col>
        </b-row>
        <b-button :to="{name: 'Home'}">Trở về</b-button>
    </b-card>
    <spinner v-if="!isLoaded"/>
  </div>
</template>

<script>
import Table from "../../apis/Table";
import Spinner from '../../views/Spinner.vue';
export default {
  components: { Spinner },
  data() {
    return {
      isLoaded: true,
      tables: [],
    };
  },
  methods: {
    getBanTrong() {
      this.isLoaded = false;
      Table.getBanTrong()
        .then((res) => {
          this.tables = res.data;
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
          this.isLoaded = true;
        });
    },
  },
  mounted() {
    this.getBanTrong();
  },
};
</script>

<style scope>
.myicon {
  background: url("http://demo.laravelmix.local:81/api/image/chung/table.png");
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
  height: 100px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
}
.myicon span {
  font-size: 20px;
  font-weight: bold;
  color: black;
  background-color: #a8f0d0e8;
  padding: 20px;
  border-radius: 50%;
}
</style>