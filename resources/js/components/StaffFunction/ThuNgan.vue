<template>
  <div>
    <b-row cols-lg="3" cols-md="2" cols-sm="1">
      <b-col @click="$router.push({ name: 'InvoiceCreate' })" style="cursor: pointer">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Tạo hóa đơn</h3>
            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="fab fa-accessible-icon"></i>
          </div>
        </div>
      </b-col>
      <b-col @click="$router.push({ name: 'InvoiceIndex' })" style="cursor: pointer">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Xem danh sách hóa đơn</h3>
            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="fab fa-accessible-icon"></i>
          </div>
        </div>
      </b-col>
      <b-col @click="$router.push({ name: 'ThemMon' })" style="cursor: pointer">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Chỉnh sửa hóa đơn</h3>
            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="fab fa-accessible-icon"></i>
          </div>
        </div>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>