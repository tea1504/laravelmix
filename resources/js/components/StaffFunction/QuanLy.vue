<template>
  <div>
    <b-container fluid>
      <b-row>
        <b-col md="3">
          <div class="small-box bg-gradient-teal">
            <div class="inner">
              <h3>Nhân viên</h3>
              <p>Quản lý nhân viên</p>
            </div>
            <div class="icon">
              <i class="fas fa-address-card"></i>
            </div>
            <a @click="$router.push({name: 'StaffIndex'})" class="small-box-footer"
              >Đi tới <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </b-col>
        <b-col md="3">
          <div class="small-box bg-gradient-info">
            <div class="inner">
              <h3>Bộ phận</h3>
              <p>Quản lý bộ phận</p>
            </div>
            <div class="icon">
              <i class="fas fa-address-book"></i>
            </div>
            <a @click="$router.push({name: 'DepartmentIndex'})" class="small-box-footer"
              >Đi tới <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </b-col>
        <b-col md="3">
          <div class="small-box bg-gradient-navy">
            <div class="inner">
              <h3>Bàn</h3>
              <p>Quản lý bàn</p>
            </div>
            <div class="icon">
              <i class="fas fa-chair text-white-50"></i>
            </div>
            <a @click="$router.push({name: 'TableIndex'})" class="small-box-footer"
              >Đi tới <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </b-col>
        <b-col md="3">
          <div class="small-box bg-gradient-indigo">
            <div class="inner">
              <h3>Loại món ăn</h3>
              <p>Quản lý loại món ăn</p>
            </div>
            <div class="icon">
              <i class="fas fa-align-left"></i>
            </div>
            <a @click="$router.push({name: 'TypeIndex'})" class="small-box-footer"
              >Đi tới <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </b-col>
        <b-col md="3">
          <div class="small-box bg-gradient-lime">
            <div class="inner">
              <h3>Món ăn</h3>
              <p>Quản lý món ăn</p>
            </div>
            <div class="icon">
              <i class="fas fa-hamburger"></i>
            </div>
            <a @click="$router.push({name: 'DishIndex'})" class="small-box-footer"
              >Đi tới <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </b-col>
        <b-col md="3">
          <div class="small-box bg-gradient-fuchsia">
            <div class="inner">
              <h3>Hóa đơn</h3>
              <p>Quản lý hóa đơn</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-invoice"></i>
            </div>
            <a @click="$router.push({name: 'InvoiceIndex'})" class="small-box-footer"
              >Đi tới <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </b-col>
        <b-col md="6">
          <div class="small-box bg-gradient-olive">
            <div class="inner">
              <h3>Báo cáo doanh thu</h3>
              <p>Báo cáo doanh thu theo tháng, theo năm, so sánh doanh thu theo tháng</p>
            </div>
            <div class="icon">
              <i class="fas fa-chart-area"></i>
            </div>
            <a @click="$router.push({name: 'DoanhThu'})" class="small-box-footer"
              >Đi tới <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
export default {
  data() {
    return {};
  },
};
</script>