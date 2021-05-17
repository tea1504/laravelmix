<template>
  <div class="p-1">
    <b-card>
      <b-button :to="{ name: 'Home' }"> Trở về </b-button>
      <b-card
        v-for="table in tables"
        :key="table.id"
        header-tag="header"
        class="my-2"
      >
        <template #header>
          <b-row>
            <b-col md="6">
              <h3>{{ table.table.name }}</h3>
            </b-col>
            <b-col md="6" class="text-right">
              <b-button @click="lenHet(table.dishes)">Đã lên hết</b-button>
            </b-col>
          </b-row>
        </template>
        <b-row cols="1" cols-lg="3" cols-md="2">
          <b-col v-for="dish in table.dishes" :key="dish.id">
            <b-card
              :img-src="dish.image"
              img-height="150"
              img-alt="Card image"
              img-left
              class="mb-3"
            >
              <b-card-text>
                <h3>{{ dish.name }}</h3>
                <p><b>Số lượng:</b> {{ dish.amount }}</p>
                <b-button @click="daLen(dish.id)">Đã lên</b-button>
              </b-card-text>
            </b-card>
          </b-col>
        </b-row>
      </b-card>
    </b-card>
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
      tables: [],
    };
  },
  methods: {
    lenMon() {
      this.isLoaded = false;
      Other.lenMon()
        .then((res) => {
          this.tables = res.data;
          this.isLoaded = true;
        })
        .catch((err) => {
          this.isLoaded = true;
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
        });
    },
    daLen(id) {
      Other.daLen(id)
        .then((res) => {
          this.lenMon();
        })
        .then((err) => {
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
        });
    },
    lenHet(dishes){
      dishes.forEach(element => {
        this.daLen(element.id);
      });
    }
  },
  mounted() {
    this.lenMon();
  },
};
</script>

<style>
</style>