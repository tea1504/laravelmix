<template>
  <div>
    <b-container fluid>
      <b-row cols-lg="3" cols-md="2" cols-sm="1">
        <b-col>
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Danh sách món ăn</h3>
              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fab fa-accessible-icon"></i>
            </div>
          </div>
        </b-col>
        <b-col
          @click="$router.push({ name: 'MonCho' })"
          style="cursor: pointer"
        >
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Danh sách món chờ</h3>
              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fab fa-accessible-icon"></i>
            </div>
          </div>
        </b-col>
        <b-col @click="lamMoiTrangThai" style="cursor: pointer">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Làm mới trạng thái</h3>
              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fab fa-accessible-icon"></i>
            </div>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Dish from "../../apis/Dish";
export default {
  methods: {
    lamMoiTrangThai() {
      this.$swal({
        title: "Xác nhận cập nhật trạng thái món ăn",
        showCancelButton: true,
        confirmButtonText: `Xác nhận`,
      }).then((result) => {
        if (result.isConfirmed) {
          Dish.setStatus()
            .then((res) => {})
            .catch((err) => {
              if (err.response.status == 401) {
                localStorage.removeItem("token");
                this.$router.push({ name: "Login" });
              } else {
                this.$swal({
                  icon: "error",
                  title: "Lỗi",
                  text: "Không thể lấy dữ liệu. Hãy thử lại sau.",
                });
              }
            });
          this.$swal("Cập nhật thành công", "", "success");
        } else if (result.isDenied) {
          this.$swal("Hủy cập nhật", "", "info");
        }
      });
    },
  },
};
</script>

<style>
</style>