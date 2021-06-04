<template>
  <div>
    <b-container fluid>
      <b-row>
        <b-col>
          <h3>
            Danh sách món ăn
            <small>(click vào món ăn để đánh dấu đã hết hàng)</small>
          </h3>
        </b-col>
        <b-container fluid style="height: 80vh" class="overflow-auto">
          <b-row>
            <b-col
              md="12"
              v-for="dish in getDish"
              :key="dish.id"
              @click="check(dish)"
              style="cursor: pointer"
            >
              <b-card
                :img-src="dish.image"
                img-alt="Card image"
                img-left
                class="mb-3"
                :class="{ het: !dish.is_serving }"
                img-height="150"
              >
                <b-card-text>
                  <h4 v-if="dish.is_serving">{{ dish.name }}</h4>
                  <h4 v-else>
                    <del>{{ dish.name }}</del>
                  </h4>
                  <p><strong>Mô tả: </strong>{{ dish.description }}</p>
                </b-card-text>
              </b-card>
            </b-col>
          </b-row>
        </b-container>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Dish from "../../apis/Dish";
export default {
  computed: {
    ...mapGetters(["getDish", "getFieldsDish"]),
  },
  methods: {
    ...mapActions(["setDish"]),
    dishIndex() {
      Dish.index()
        .then((res) => {
          this.setDish(res.data);
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
        });
    },
    check(dish) {
      if (dish.is_serving)
        this.$swal({
          title: "Món ăn đã hết hàng ?",
          showCancelButton: true,
        }).then((result) => {
          if (result.isConfirmed) {
            this.hetHang(dish);
          }
        });
      else
        this.$swal({
          title: "Bạn muốn khôi phục trạng thái ?",
          showCancelButton: true,
        }).then((result) => {
          if (result.isConfirmed) {
            this.khoiPhuc(dish);
          }
        });
    },
    hetHang(dish) {
      Dish.hetHang(dish.id).then((res) => {
        this.dishIndex();
      });
      this.$swal({
        icon: "success",
        title: "Đã đánh dấu hết hàng",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
      });
    },
    khoiPhuc(dish) {
      Dish.khoiPhuc(dish.id).then((res) => {
        this.dishIndex();
      });
      this.$swal({
        icon: "success",
        title: "Đã khôi phục trạng thái",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
      });
    },
  },
};
</script>

<style>
.card.het img {
  filter: grayscale(100%);
}
</style>